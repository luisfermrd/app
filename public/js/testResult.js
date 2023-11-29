async function validate() {
  let data = new FormData();
  data.append("controller", "test");
  data.append("action", "readTests");
  data.append("studentID", $("#studentID").val());
  await $.ajax({
    type: "post",
    url: "../indexRequest.php",
    data: data,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response.status == "success") {
        if (response.data.length != 0) {
            console.log('Tiene data');
            console.log(response);
            $("#name").text('Hola, '+response.data[0].UserName);
        }else{
            $(location).attr("href", "home.php");
        }
      } else {
        Toastify({
          text: response.message,
          duration: 4000,
          style: {
            background: "linear-gradient(to right, #ef4444, #b91c1c)",
          },
        }).showToast();
      }
    },
  });
}

validate();
