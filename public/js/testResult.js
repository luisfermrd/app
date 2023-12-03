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
          console.log("Tiene data");
          console.log(response);
          $("#respondioTest").css("display", "flex");
          $("#name").text("Hola, " + response.data[0].UserName);
          $("#img2").css("left", response.data[0].Punctuation - 3 + "%");
          $("#resultadoTest").html(response.data[0].Description);
        } else {
          $("#noRespondioTest").css("display", "block");
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

document.querySelectorAll("#backToHome").forEach((element) => {
  element.addEventListener("click", () => {
    $(location).attr("href", "home.php");
  });
});
document.querySelectorAll("#backToHome2").forEach((element) => {
  element.addEventListener("click", () => {
    $(location).attr("href", "student.php");
  });
});
