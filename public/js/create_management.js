const inputElement =document.getElementById('uppercase_field');

inputElement.addEventListener('input', function() {
    this.value = this.value.toUpperCase()
})