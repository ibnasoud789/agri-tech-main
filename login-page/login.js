let id = (id) => document.getElementById(id);

let classes = (classes) => document.getElementsByClassName(classes);

let userid = id('userid'),
    password = id('password'),
    form = id('form'),
    errorMsg = classes('error'),
    successIcon = classes('success-icon'),
    failureIcon = classes('failure-icon');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  engine(userid,0,'Please enter your userID!');
  engine(password,1,'Please enter your password!');
})

let engine = (id, index, message) =>{
  if(id.value.trim() === ''){
    errorMsg[index].innerHTML = message;
    failureIcon[index].style.opacity = '1';
    successIcon[index].style.opacity = '0';
  }else if(id===password && id.value.trim().length<=6){
    errorMsg[index].innerHTML= 'Invalid Password!'
    failureIcon[index].style.opacity = '1';
    successIcon[index].style.opacity = '0';

  }  else{
    errorMsg[index].innerHTML = '';
    successIcon[index].style.opacity = '1';
    failureIcon[index].style.opacity = '0';
  }
}