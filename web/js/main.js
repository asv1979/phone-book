jQuery(function(){let phoneInput = $("#phone-phone");
    if(phoneInput.length){
        phoneInput.val("+38 0");  // start value
        phoneInput.mask("+389 999 999 99 99", {
            autoclear: false
        });
        phoneInput.focus();  // set focus
        phoneInput.selectionStart = 5;   // cursor position
        phoneInput.on("keyup",function(){
            onKeyUpPhone(phoneInput);
        });
    }
});

/**
 * check entered number
 * @param idPhone id поля input
 * @returns {Boolean}
 */
function onKeyUpPhone(idPhone) {
    let arrPrefix = ['39','50','63', '66', '67', '68', '73', '91','92', '93', '95', '96', '97', '98', '99'],
        str = idPhone.val(),
        strNum = str.replace(/\D+/g,"");  

    console.log(strNum.length);
    console.log('str='+strNum);

    if (strNum.length > 5) {
        let flag = false; // number invalid sign
        console.log(str);
        if (str.substring(0, 5) !== '+38 0') {
            flag = true;
        } else {
            let prefix = strNum.substring(3, 5);   // operator prefix
            flag = true;
            // array of mobile phone prefixes:
            arrPrefix.forEach(function(item, i, arr) {
                //console.log('item='+item);
                if (item === prefix){
                    flag = false;
                }
            });
        }

        // if the number is invalid:
        if (flag) {
            idPhone.val("+380");
            strNum = '38 0';
            idPhone.mask("+38 999 999 99 99", {
                autoclear: false
            });
            idPhone.focus();  
            idPhone.selectionStart = 5;
        }
    } else {
        if (strNum.length < 4) {
            idPhone.val("+38 0");
            idPhone.mask("+38 999 999 99 99", {
                autoclear: false
            });
            idPhone.focus();   
            idPhone.selectionStart = 5;
        }
    }

    return true;
}
