---
layout: post
title:  How to Drag or swipe in RecyclerView
noindex: true
---

![](https://chromicle.files.wordpress.com/2019/05/gestures-tap-swipe.png)

Drag or swipe

There’s actually a **really simple** way to add these features to RecyclerView. It only requires one class, and it’s already part of the Android Support Library called "ItemTouchHelper"

By the help of ItemTouchHelper we can add the swipe and drag features by adding sub class. It’s a subclass of [RecyclerView.ItemDecoration](https://developer.android.com/reference/android/support/v7/widget/RecyclerView.ItemDecoration.html), I’ll demonstrate a simple implementation of ItemTouchHelper.

### Setting up

First thing we need is a basic RecyclerView setup. If you haven’t already, update your build.gradle to include the RecyclerView dependency.

`compile 'com.android.support:recyclerview-v7:22.2.0'`

### BY ItemTouchHelper and ItemTouchHelper.Callback

In order to use ItemTouchHelper, you’ll create an [ItemTouchHelper.Callback](https://developer.android.com/reference/android/support/v7/widget/helper/ItemTouchHelper.Callback.html). This is the interface that allows you to listen for “move” and “swipe” events. It’s also where you are able to control the state of the view selected, and override the default animations. There’s a helper class that you can use if you want a basic implementation, [SimpleCallback](https://developer.android.com/reference/android/support/v7/widget/helper/ItemTouchHelper.SimpleCallback.html),

The main callbacks that we must override to enable basic drag & drop and swipe-to-dismiss are:

```
getMovementFlags(RecyclerView, ViewHolder) 
onMove(RecyclerView, ViewHolder, ViewHolder) 
onSwiped(ViewHolder, int)
```

**We can also use a some of helpers:**
```
isLongPressDragEnabled()
isItemViewSwipeEnabled()
```
We’ll go through them one by one.

```
@Override  
public int getMovementFlags(RecyclerView recyclerView,   
        RecyclerView.ViewHolder viewHolder) {  
    int dragFlags = ItemTouchHelper.UP | ItemTouchHelper.DOWN;  
    int swipeFlags = ItemTouchHelper.START | ItemTouchHelper.END;  
    return makeMovementFlags(dragFlags, swipeFlags);  
}
```

It will help you get the direction. You must override **getMovementFlags**() to specify which directions of drags and swipes. Use the helper **ItemTouchHelper.makeMovementFlags(int, int)** to build the returned flags. We’re enabling dragging and swiping in both directions here.

```
@Override  
public boolean isLongPressDragEnabled() {  
    return true;  
}
```
ItemTouchHelper can be used for drag _without_ swipe (or vice versa), so you must designate exactly what you wish to support. Implementations should return true from **isLongPressDragEnabled()** will detect when we long press the any item in recyclerView

```
@Override  
public boolean isItemViewSwipeEnabled() {  
    return true;  
}
```
to enable swiping we have to return true from **isItemViewSwipeEnabled**().

**onMove()** and **onSwiped()** are used to notify anything of updating data. So first we’ll create an interface that allows us to pass these event callbacks back.
```
public interface ItemTouchHelperAdapter {  
  
    void onItemMove(int fromPosition, int toPosition);  
  
    void onItemDismiss(int position);  
}
```
**ItemTouchHelper.java**
```
public class RecyclerListAdapter extends   
        RecyclerView.Adapter<ItemViewHolder>   
        implements ItemTouchHelperAdapter {

@Override  
public void onItemDismiss(int position) {  
    mItems.remove(position);  
    notifyItemRemoved(position);  
}  
  
@Override  
public boolean onItemMove(int fromPosition, int toPosition) {  
    if (fromPosition < toPosition) {  
        for (int i = fromPosition; i < toPosition; i++) {  
            Collections.swap(mItems, i, i + 1);  
        }  
    } else {  
        for (int i = fromPosition; i > toPosition; i--) {  
            Collections.swap(mItems, i, i - 1);  
        }  
    }  
    notifyItemMoved(fromPosition, toPosition);  
    return true;  
}
```

It’s very important to call **notifyItemRemoved()** and **notifyItemMoved()** so the Adapter can identify the changes.

Now we can go back to building our **SimpleItemTouchHelperCallback** as we still must override onMove() and onSwiped(). First add a constructor and a field for the Adapter:

```
private final ItemTouchHelperAdapter mAdapter;  
  
public SimpleItemTouchHelperCallback(  
        ItemTouchHelperAdapter adapter) {  
    mAdapter = adapter;  
}
```
Then override the remaining events and notify the adapter:

```
@Override  
public boolean **onMove**(RecyclerView recyclerView,   
        RecyclerView.ViewHolder viewHolder,   
        RecyclerView.ViewHolder target) {

mAdapter.onItemMove(viewHolder.getAdapterPosition(),   
            target.getAdapterPosition());

    return true;  
}

@Override  
public void onSwiped(RecyclerView.ViewHolder viewHolder,   
        int direction) {  
    mAdapter.onItemDismiss(viewHolder.getAdapterPosition());  
}
```
With our Callback, we can create our ItemTouchHelper and call **attachToRecyclerView(RecyclerView):**
```
ItemTouchHelper.Callback callback =   
new SimpleItemTouchHelperCallback(adapter);  
ItemTouchHelper touchHelper= new ItemTouchHelper(callback);  
touchHelper.attachToRecyclerView(recyclerView);
```


Thanks Happy coding :)