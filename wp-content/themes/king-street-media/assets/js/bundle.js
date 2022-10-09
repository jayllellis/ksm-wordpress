/* ScrollTrigger */
const scrollTriggerDefaults = document.querySelectorAll('.scrolltrigger__default');
if( scrollTriggerDefaults.length > 0 ) {
  scrollTriggerDefaults.forEach((el) => {
    let id = el.getAttribute('id');
    ScrollTrigger.create({
      trigger: `#${id}`,
      start: "top center",
      end: "bottom top",
      toggleClass: "on-screen",
      once: true,
      // markers: true,
    });
  });
}
