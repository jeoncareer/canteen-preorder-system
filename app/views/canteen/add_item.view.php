<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            height:10000px;
        }
        .container{
            
            display: flex;
            flex-direction: column;
            width:600px;
            border: 1px solid black;
            margin:0 auto ;
        }

        .top{
            background-color: #6366F1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color:white;
            padding:40px 0;
            row-gap: 15px;
        }

        .l{
            display: flex;
            flex-direction: column;
        }


        .cred{
            display: flex;
            flex-direction: column;
           padding:40px;
           row-gap: 25px;
        }

        .cred label{
            font-weight: bold;
        }

        .cat-pri{
            display: flex;
            flex-direction: row;
        }

        .cat-pri > div{
            display: flex;
            flex-direction: column;
        }

        

          .upload-box {
    border: 2px dashed #ccc;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #f9f9ff;
    color: #333;
    font-weight: bold;
    cursor: pointer;
    transition: border-color 0.3s;
  }

  .upload-box:hover {
    border-color: #7f8c8d;
  }

  .upload-box img {
    width: 20px;
    height: 20px;
  }

  #item_image {
    display: none;
  }
    </style>
</head>
<body>
    <h1 style="margin-bottom:200px">Campus Canteen</h1>
  <div class="container">
    <div class="top">
        <h1>Add New Item</h1>
        <div>Add delicious items to your canteen menu</div>
    </div>



    <div class="cred">
        <div class="l">

            <label for="">Item Name</label>
            <input type="text" name="item_name" placeholder="e.g,Chicken Biriyani">
        </div>
        <div class="l">

            <label for="">Item Description</label>
            <textarea name="description" id="" placeholder="Describe your delicious item,ingredients, and what makes it special"></textarea>
        </div>

        <div class="l">

            <div class="cat-pri">
                <div>
    
                    <label for="">Category</label>
                    <select name="category" id="" >
                        <option value="">Select a category</option>
                    </select>
                </div>
                <div>
    
                    <label for="">Price</label>
                    <input type="number" name="price">
                </div>
    
            </div>
        </div>
        <div class="l">

            <label for="item_image" class="upload-box">
      <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" alt="Camera Icon">
      Choose an appetizing image of your item
    </label>
    <input type="file" id="item_image" name="item_image" accept="image/*">
        </div>

        <div class="l">

            <button>ADD ITEM TO MENU</button>
        </div>
    </div>


  </div>
</body>
</html>