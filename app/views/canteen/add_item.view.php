<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT?>assets/css/add_item.css">
    <style>


        




    </style>
</head>
<body>
    <form action="<?=ROOT?>/canteen/add_item" method="post" enctype="multipart/form-data">

        <div class="container">
          <div class="top">
              <h1>Add New Item</h1>
              <div>Add delicious items to your canteen menu</div>
          </div>
      
      
      
          <div class="cred">
              <div class="l">
      
                  <label for="">Item Name</label>
                  <input class="item-name" type="text" name="item_name" placeholder="e.g,Chicken Biriyani">
              </div>
              <div class="l">
      
                  <label for="">Item Description</label>
                  <textarea class="description" name="description" id="" 
                  placeholder="Describe your delicious item,ingredients, and what makes it special........"></textarea>
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
      
                <label for="">Item Image</label>
                <input class="item-image" type="file" name="item_image">
              </div>
      
              <div class="l">
      
                  <button>ADD ITEM TO MENU</button>
              </div>
          </div>
      
      
        </div>
    </form>
</body>
</html>