// ⚡️ DANGER ZONE ⚡️
// ================
// 

self.addEventListener("activate", e => e.waitUntil(onDeactivate(e)));

async function onDeactivate() {
  await self.clients.claim();

  const keys = await caches.keys();

  return Promise.all(
    keys
      // Only consider caches created by this baseurl, i.e. allow multiple Hydejack installations on same domain.
      .filter(key => key.endsWith("sw/"))
      // Delete *all* caches
      .map(key => caches.delete(key))
  );
}
// 
