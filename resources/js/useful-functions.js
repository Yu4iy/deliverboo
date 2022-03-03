var inputNumbers = document.querySelectorAll('input[type="number"]');
var iva = document.getElementById('iva');
const numbers = ['0','1','2','3','4','5','6','7','8','9','.'];
if(iva != null) {
    iva.addEventListener('keypress', function(e) {
        if(!numbers.includes(e.key)){
            e.preventDefault();                      
        }
    })
}
inputNumbers.forEach(el => {
    el.addEventListener('keypress', function(e){
      if(!numbers.includes(e.key)) {
        e.preventDefault();
      }
    })
})