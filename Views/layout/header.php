<!doctype html>
<html lang="en">
<head id="head-snipet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/003ee0b599.js" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Imageboard</title>
</head>
<body>
<main class="container mt-5 mb-5">
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #fff;
  margin: 0;
  padding: 0;
}
header {
  background-color: #ffcc00;
  padding: 10px;
  color: #fff;
  font-size: larger;
}

footer {
  text-align: center;
  font-weight: bold;
  color: #848484;
}
.container {
  padding: 20px;
}
label{
  font-size: large;
  font-weight: bold;
  color: #848484;
}

.thumb-image{
  width: 50%;
  margin: auto;
  display: block;
}

.image-aleart{
  color: #e99795;
  font-size:small;
  font-weight: lighter;
}
input,select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid #ddd;
  box-sizing: border-box;
}
button {
  background-color: #ffcc00;
  color: #fff;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  font-weight: bold;
  margin-top: 10px;
}

.image-container{
  font-size: large;
  font-weight: bold;
  color: #848484;
  margin-top: 10px;
  .snipet-data{
    margin-left: 10px;
  }
}
.snippet-list {
  padding-left: 10px;
  padding-top: 10px;
  margin-top: 20px;
  border-top: 1px solid lightgray;
  h3 {
    color: #ffcc00;
  }
  h5{
    padding: 10px 0;
    color: #848484;
  }
}

#input-container {
  width: 100%;
  margin: 10px 0;
  height: 500px;
  border: 2px solid #ddd;
  box-sizing: border-box;
}

/* .images-container{
  margin: 0 auto;  
} */

/* .image-item:hover{
  color: inherit;
  background-color: #fff2bf;
  transition: 0.1s;
  opacity: 0.5;
} */
.image-item{
  padding: 10px;
  width: 45%;
  height: 30%;
  background-color: #f0ebe9;
  color: black;
  margin: 1% auto;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.image-single {
  width: 80%;
  /* height: 400px; */
  margin: auto;
  display: block;
  object-fit: cover;
  
}

.image-detail {
  height: 400px;
  margin: auto;
  display: block;
  object-fit: cover;
  cursor: pointer;
}

.post-child{
  padding: 1% 0 0 2%;
}

.no-exist{
  text-align: center;
  h2 {
    padding: 20px;
  }
}

.not-found{
  text-align: center;
  h2 {
    padding: 20px;
  }
}

i {
  color:white;
  font-size: larger;
  font-weight: bolder;
  margin-left: 5px;
}

.parent-icon{
  color: black;
  font-size:large;
  margin: 0 5px 0 0;
}

</style>

<header>
  <div>
    <a href="/"><i class="fa-solid fa-plus"></i></a>
    <a href="/posts"><i class="fa-solid fa-list"></i></a>
  </div>
</header>