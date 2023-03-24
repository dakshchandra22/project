const form = document.querySelector('form');
form.addEventListener('submit', (event) => {
   event.preventDefault();
   const classSelected = document.querySelector('#class').value;
   const dateSelected = document.querySelector('#date').value;
   const timeSelected = document.querySelector('#time').value;
   alert(`You have booked a ${classSelected} class on ${dateSelected} at ${timeSelected}`);
});
