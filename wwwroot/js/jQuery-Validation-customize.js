$.validator.addMethod("passwordCheck", function(value) {
    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /\d/.test(value) // has a digit
            && /[a-z]/.test(value) // has a lowercase letter
            && /[A-Z]/.test(value) // has a lowercase letter
}, "Password must contain at least a digit, a lowercase letter and an uppercase digit");