<div class="container">
  <form enctype="multipart/form-data" id="create-form"  action="#" method="post">
      <div class="form-group">
        <label for="subject">subject</label>
        <input type="text" name="subject" id="subject" value="Hello Javascript">
      </div>
      <div class="form-group">
        <label for="content">content</label>
        <input type="text" name="content" id="content" value="Hello Javascript">
      </div>
      <div class="form-group">
        <label for="img">image<span class="image-aleart"> support only <strong>png, jpeg, jpg, gif (by 20Mbyte)</strong></span></label>
        <input name="img" accept=".png,.jpeg,.jpg,.gif" id="fileUpload" type="file">
        <div id="image-holder"></div>
      </div>
      <input type="hidden" name="reply_to_id" id="reply_to_id" value=1>
      <button type="submit" name="submit">Register</button>
  </form>
</div>

<script>
  $("#fileUpload").on('change', function () {
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                        "class": "thumb-image"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    } else {
        alert("Pls select only images");
    }
  });

//   document.addEventListener('DOMContentLoaded', function () {
//   // フォームを選択します
//   const form = document.getElementById('create-form');

//   form.addEventListener('submit', function (event) {
//       // デフォルトのフォーム送信を防止します
//       event.preventDefault();

//       // FormDataオブジェクトを作成し、コンストラクタにフォームを渡してすべての入力値を取得します
//       const formData = new FormData(form);

//       // fetchリクエストを送信します
//       fetch('/form/create/post', {
//           method: 'POST',
//           body: formData
//       })
//         .then(response => response.json())
//         .then(data => {
//             console.log(data)
//             // サーバからのレスポンスデータを処理します
//             if (data.status === 'success') {
//                 // 成功メッセージを表示したり、リダイレクトしたり、コンソールにログを出力する可能性があります
//                 console.log(data.message);
//                 alert('create successful!');
//                 if (!formData.has('id')) form.reset();
//             } else if (data.status === 'error') {
//                 // ユーザーにエラーメッセージを表示します
//                 console.log(data)
//                 console.error(data.message);
//                 alert('created failed: ' + data.message);
//             }
//         })
//         .catch((error) => {
//             // ネットワークエラーかJSONの解析エラー
//             console.error('Error:', error);
//             alert('An error occurred. Please try again.');
//         });
//     });
// });
</script>
<script src="/js/app.js"></script>