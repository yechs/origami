window.addEventListener("load", function() {
  var custom_uploader;
  document
    .querySelector("#upload_image_button")
    .addEventListener("click", function(e) {
      e.preventDefault();
      if (custom_uploader) {
        custom_uploader.open();
        return;
      }
      custom_uploader = wp.media.frames.file_frame = wp.media({
        title: "Choose Image",
        button: {
          text: "Choose Image"
        },
        multiple: false
      });
      custom_uploader.on("select", function() {
        attachment = custom_uploader
          .state()
          .get("selection")
          .first()
          .toJSON();
        document.querySelector("#upload_image").value = attachment.url;
      });
      custom_uploader.open();
    });
});