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
      id: "#user_phone",
      regexp: /^[0-9]{10}$/,
      errId: ".phone-error",
      errText: "Invaid phone number",
    },
    {
      id: "#user_email",
      regexp: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,30}$/,
      errId: ".email-error",
      errText: "Invaid email",
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
      id: "#user_address",
      regexp: /^[a-zA-Z0-9\s,'-]+$/,
      errId: ".address-error",
      errText: "Invaid address",
    },
    {
      id: "#user_pincode",
      regexp: /^[0-9]{6}$/,
      errId: ".pincode-error",
      errText: "Invaid pincode",
    },
    {
      id: "#user_state",
      regexp: /^[a-zA-Z]+$/,
      errId: ".state-error",
      errText: "",
    },
    {
      id: "#user_district",
      regexp: /^[a-zA-Z]+$/,
      errId: ".district-error",
      errText: "",
    },
    {
      id: "#item_name",
      regexp: /^[a-zA-Z ]+$/,
      errId: ".item-error",
      errText: "Invalid item name",
    },
    {
      id: "#item_price",
      regexp: /^[0-9]+$/,
      errId: ".price-error",
      errText: "Only numbers allowed",
    },
    {
      id: "#item_description",
      regexp: /^[a-zA-Z0-9 ]{1,255}$/,
      errId: ".description-error",
      errText: "Max length must be 255 only",
    },
    {
      id: "#item_image",
      regexp: /(\.jpg|\.jpeg|\.png|\.gif)$/i,
      errId: ".image-error",
      errText: "Invalid type of image",
    }
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
