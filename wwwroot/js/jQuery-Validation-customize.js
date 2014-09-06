$.validator.addMethod("passwordCheck", function(value) {
    return /^[A-Za-z0-9]*$/.test(value) // consists of only alphanumeric
            && /\d/.test(value) // has a digit
            && /[a-zA-Z]/.test(value) // has at least a letter
}, "Password must contain at least a digit, a letter");