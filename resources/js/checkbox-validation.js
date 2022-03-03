
var btn = document.getElementById('btn-submit');
btn.addEventListener('click', function(e) {
  var len = document.querySelectorAll('.checkbox:checked').length;
  if (len <= 0) {
      formCheckbox = document.getElementById('form-checkbox');
      e.preventDefault();
      errorMessage = document.createElement('p');
      formCheckbox.append(errorMessage);
      errorMessage.innerHTML = 'Please check at least one!';
  }
})

var inputNumbers = document.querySelectorAll('input[type="number"]')
inputNumbers.forEach(el => {
    const numbers = ['0',1,2,3,4,5,6,7,8,9,'.'];
    el.addEventListener('keypress', function(e){
      console.log(e)
      if(!numbers.includes(e.key)) {
        e.preventDefault();
      }
    })
})
