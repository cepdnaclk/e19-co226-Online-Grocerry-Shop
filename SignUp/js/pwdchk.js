function checkPassword(){
    let password = document.getElementById("password").value;
    let cnfrmPassword = document.getElementById("re-enter-password").value;

    console.log("Password:", password);
    console.log("Confirm Password:", cnfrmPassword);


    if(password == cnfrmPassword){
        return true;
    }
    else{
        alert("Password doesn't Match");
        return false; 
    }
    
}

function email(){
    
}