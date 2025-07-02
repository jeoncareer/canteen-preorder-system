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


  <div class="main">
    <form action="<?=ROOT?>canteen/add_item" method="post" enctype="multipart/form-data">

        <div class="container">
          <div class="top">
              <h1>Add New Item</h1>
              <div>Add delicious items to your canteen menu</div>
          </div>
      
      
      
          <div class="cred">
              <div class="l">
      
                  <label for="">Item Name</label>
                  <input class="item-name" type="text" name="item_name" placeholder="e.g,Chicken Biriyani">
                  <?php if (!empty($errors['item_name'])):?>
                  <span class="error">&bull; <?=$errors['item_name']?></span>
                  <?php endif; ?>
              </div>
              <div class="l">
      
                  <label for="">Item Description</label>
                  <textarea class="description" name="description" id="" 
                  placeholder="Describe your delicious item,ingredients, and what makes it special........"></textarea>
                    <?php if (!empty($errors['description'])):?>
                  <span class="error">&bull; <?=$errors['description']?></span>
                  <?php endif; ?>
              </div>
      
              <div class="l">
      
                  <div class="cat-pri">
                      <div>
          
                          <label for="">Category</label>
                          <select name="category_id" id="" >
                              <option value="" disabled selected>Select a category</option>
                              <?php if (isset($categories)):?>
                              <?php foreach ($categories as $category):?>
                                <option value="<?=$category->id?>"><?=ucfirst($category->name)?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                          </select>
                            <?php if (!empty($errors['category'])):?>
                  <span class="error">&bull; <?=$errors['category']?></span>
                  <?php endif; ?>
                      </div>
                      <div>
          
                          <label for="">Price</label>
                          <input type="number" name="price">
                            <?php if (!empty($errors['price'])):?>
                  <span class="error">&bull; <?=$errors['price']?></span>
                  <?php endif; ?>
                      </div>
          
                  </div>
              </div>
              <div class="l">
      
                <label for="">Item Image</label>
                <input class="item-image" type="file" name="item_image">
                  <?php if (!empty($errors['item_image'])):?>
                  <span class="error">&bull; <?=$errors['item_image']?></span>
                  <?php endif; ?>
              </div>
      
              <div class="l">
      
                  <button>ADD ITEM TO MENU</button>
              </div>
          </div>
      
      
        </div>
    </form>
      <form action="<?=ROOT?>canteen/category" method="post">

  <div class="form-container">
    <h2>Add New Category</h2>
    <form action="add_category.php" method="POST">
      <label for="category_name">Category Name</label>
      <input type="text" id="category_name" name="category_name" placeholder="e.g., Snacks, Drinks" required>

      <input type="submit" value="Add Category">
    </form>
  </div>
    </form>
  </div>




</body>
</html>