export function getBaseUrl () {
  return window.location.pathname.split('backend')[0];
}
export function getCsrfToken () {
  const tokenMeta = document.head.querySelector('meta[name="csrf-token"]');
  return tokenMeta ? tokenMeta.content : '';
}
export function getFrontendUrl () {
  const frontendUrlMeta = document.head.querySelector('meta[name="frontend_url"]');
  return frontendUrlMeta ? frontendUrlMeta.content : '';
}
