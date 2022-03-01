
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