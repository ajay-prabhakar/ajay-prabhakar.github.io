---
layout: post
title:  MVVM with Dagger 2, Retrofit, RxJava
tags: Android, MVVM 
noindex: true
---

MVVM with Dagger 2, Retrofit, RxJava
=====================================================================

I used to work with MVP pattern until now. However, when Google released nice-to-use components like the `ViewModel` along with the [**Android Jetpack**](https://developer.android.com/jetpack/), I have tried to work with **MVVM** pattern. In this article, we will see how can we use the MVVM pattern with [Retrofit](https://github.com/square/retrofit), [RxJava](https://github.com/ReactiveX/RxJava), and [Dagger 2](https://github.com/google/dagger).

What is MVVM?
-------------

_Model-View-ViewModel_ architecture consists of 3 parts.

*   The **View** gets user’s actions and sends to the `ViewModel`, or listens live data stream from the `ViewModel` and provides to the users.
*   The **ViewModel** gets user’s actions from the `View` or provides data to `View`.
*   The **Model** abstracts the data source. `View` and `ViewModel` uses that on data stream.

Project Configuration
---------------------

We implement Android Lifecycle, Retrofit, RxJava, ButterKnife and Dagger 2 libraries in addition to Support libraries.



Setting Up Retrofit Interface
-----------------------------

We have used Github API for _Json_ source and as you see `Single<>` return type in order to observe data with `RxJava`.

<script src="https://gist.github.com/Chromicle/70d99c35f6b28984c912e52addfd4423.js"></script>

Setting Up Application Class, Base Activity, Base Fragment
----------------------------------------------------------

We have to use `DaggerApplication`, `DaggerAppCompatActivity` and `DaggerFragment` classes for injecting objects with `ContributesAndroidInjector` annotation.

<script src="https://gist.github.com/Chromicle/3ced1f5c5ce514110ccd8fc3c9df4e6d.js"></script>

<script src="https://gist.github.com/Chromicle/ad7233980ccbf8639abc82b4c31cc5f7.js"></script>
We have used abstract `layoutRes()` function in order to get resource layout id from Activity which extends `BaseActivity`.
<script src="https://gist.github.com/Chromicle/c2020f1aec05e385783f77b3c362c3de.js"></script>

Setting Up Dagger 2 Component & Modules
---------------------------------------
<script src="https://gist.github.com/Chromicle/9dff782d9801caddeab827490f2c55bf.js"></script>

As you can see, we have wrote only `AndroidSupportInjectionModule`, `ActivityBindingModule` and `ViewModelModule` to the module parameter. We will write other required modules in which Activity or Fragment they needed.

If explain what we have did in that code snippet;

*   `provideRetrofit` — Provides Retrofit adjusted with `base url`, adapter and converter factories. `addCallAdapterFactory()` function gets adapter factory for supporting service method return types, add instance of `RxJava2CallAdapterFactory`  for RxJava support.
*   `provideRepoService`— Provides Retrofit interface class for making requests.

<script src="https://gist.github.com/Chromicle/3aab7323c9afb4312b3e43a2c20254fc.js"></script>

Creating Custom ViewModel Factory
---------------------------------

ViewModelFactory is a factory that extends `ViewModelProvider.Factory` in order to provide `ViewModel` instances to consumer fragment classes. We have injected that class with the `ViewModelModule`.

<script src="https://gist.github.com/Chromicle/70d0a83b9b1f1f1959446f8af9dd59f8.js"></script>

Setting Up ViewModel
--------------------

In `ViewModel`, we will assign the data which loaded with Retrofit to the `MutableLiveData`. So, how we can use [MutableLiveData](https://developer.android.com/reference/android/arch/lifecycle/MutableLiveData)? We assign the data to MutableLiveData with `setValue` or `postValue` methods, and observe this data in `LifeCycleOwner` (Activity or Fragment). When we make any changes on the `MutableLiveData`, this change is dynamically declared to the view. Also, It does not oblige us to check whether `View` is alive in every transaction.

<script src="https://gist.github.com/Chromicle/b04ebb6a267d2d40a8c5f6989a4d7bc5.js"></script>

As you can see, we didn’t use any `component` injecting code, because we have injected all required classes in the `MainFragmentBindingModule` and also we have did same thing for activities in the `ActivityBindingModule`.

Setting Up Fragment
-------------------

As you know, fragment is our `View` part. We have injected `ViewModelFactory` and started to observe `LiveData` objects.

<script src="https://gist.github.com/Chromicle/facff74cdba76330c8c70fb768d6eb88.js"></script>

Creating RecyclerView Adapter
-----------------------------

In recyclerView adapter, we have only observed `List<Repo>` `LiveData` and bind them to the `recyclerView`.

<script src="https://gist.github.com/Chromicle/429b1ff54c460f4f740a0053cc8f5500.js"></script>

MVVM vs MVP
-----------------------------


Previously I implemented a very similar app using MVP architecture here. Let’s compare the two architectures:
1. Goodbye Presenter, Hello ViewModel! ViewModel in MVVM is an equivalent to Presenter in MVP architecture.
MVP contains slightly more code. For instance, my Presenter extended a common base Presenter. I had View and Presenter interfaces and Contract interface to tie them together.
2. In MVP Activity#onSaveInstanceState() and Activity#onRestoreInstanceState() callbacks can be used to save state between configuration changes such as device rotation. If you use the new architecture component ViewModel in MVVM, data survives rotations automatically.
3. MVP requires tighter component coupling. The Presenter keeps a reference to the View, albeit via an interface. It is necessary because the View often needs to inform the Presenter of lifecycle events such as onStop() or onDestroy() so that the Presenter can clear RxJava Subscriptions, etc. In MVVM you simply override ViewModel#onCleared() to do the cleanup without the View getting involved.
4. In MVP, the View delegates all the work to the Presenter and the latter then tells the View what results to display. Similarly, in MVVM, the View delegates all the work to the ViewModel but then the View observes and reacts to the responses from the ViewModel.
5. While there is no one-size-fits-all when it comes to Android apps, for the reasons outlined above, MVVM architecture seems to have an advantage over MVP. While both are great at keeping business logic away from the View, abstracting data layer and making the code highly testable and maintainable, going forward, whenever I architect a new Android application, I will likely consider MVVM first

Thanks a lot for reading, Happy coding :)