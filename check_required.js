
var inputs = document.getElementsByTagName('input');
function sbmt(){
    for(var i=0; i < inputs.length; i++){
        if(inputs[i].value === '' && inputs[i].hasAttribute('required')){
            alert('all fields must be entered');
            return false;
        }
    }
    document.getElementsByTagName('form').submit();
};