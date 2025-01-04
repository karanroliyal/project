$(document).ready(function () {
  console.log(" i am working hahaa");

  // validating fields of add user master

  class formValidation {
    constructor(value, regexp, errId, errText) {
      this.value = value;
      this.regexp = regexp;
      this.errId = errId;
      this.errText = errText;
    }

    validation() {
      if (this.regexp.test(this.value)) {
        $(this.errId).text("");
      } else if (this.value == "") {
        $(this.errId).text("");
      } else {
        $(this.errId).text(this.errText);
      }
    }
  }

  // fields data for validation

  fieldsData = [
    {
      id: "#user_name",
      regexp: /^[a-zA-Z\ ]{3,30}$/,
      errId: ".name-error",
      errText:
        "Only characters are allowed and name must be longer that 2 characters",
    },
    {
      id: "#user_password",
      regexp:
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!%*?&]{8,15}$/,
      errId: ".password-error",
      errText:
        "1 Uppercase , 1 special character , min length 8 is required and max length is 15",
    },
    {
      id: "#user_email",
      regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,30}$/,
      errId: ".email-error",
      errText: "Invaid email",
    },
    {
      id: "#user_phone",
      regexp: /^[0-9]{10}$/,
      errId: ".phone-error",
      errText: "Invaid phone number",
    },
  ];

  // Input taking for validation

  fieldsData.map((ele) => {
    $(ele.id).on("input", function () {
      let value = $(ele.id).val().trim();

      let valObj = new formValidation(
        value,
        ele.regexp,
        ele.errId,
        ele.errText
      );

      valObj.validation();
    });
  });

  





});
