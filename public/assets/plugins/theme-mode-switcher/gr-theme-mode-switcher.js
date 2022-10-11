// dark lite changer
const toggleSwitch = document.querySelector(".toggle-button");
const documentBody = document.body;

toggleSwitch.addEventListener("change", function(e){
  const mode = e.target.checked === true ? 'dark' : 'light';
  documentBody.setAttribute("data-theme", mode);
});

window.addEventListener('load', () => {
  const mode = localStorage.getItem('color_mode') ?? 'light';
  document.body.setAttribute("data-theme", mode);
})

const observer = new MutationObserver(function() {
  const mode = documentBody.getAttribute('data-theme');

  localStorage.setItem('color_mode', mode);
  toggleSwitch.checked = mode === 'dark' ? true : false;
});

observer.observe(documentBody, {attributeFilter: ['data-theme']});
