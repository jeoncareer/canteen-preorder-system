<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>

        *{
            margin:0;
            padding:0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container{
            display: flex;
            flex-direction: row;
            align-items: center;
            border:none;
            width:850px;
            margin:0 auto;
            margin-bottom: 50px;
            padding:25px;
            justify-content: space-between;
            background-color: white;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
            border-radius: 20px;
            
        }
        
        .bottom{
            color:#9C9C9C;
        }

        .top{
            color: #6366F1;
        }


        .middle{

            display: flex;
            flex-direction: column;
            row-gap: 10px;
        }


        .details{
            display: flex;
            flex-direction: column;
            row-gap: 10px;
        }


        .buttons{
            display: flex;
            flex-direction: column;
            row-gap: 10px;
        }
        

        .loc-details{
            display: flex;
            flex-direction: row;
            column-gap: 25px;
            color:#9C9C9C;
        }

        .description{
            width:650px;
            color: #5a6c7d;
        }


        .buttons button{
            background-color: #6366F1;
            border:none;
            color:white;
            font-weight: bold;
            font-size: 19px;
            padding:10px 20px;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s;
            
        }

        .buttons button:hover{
            padding:10px 24px;
            opacity: 0.9;
            box-shadow: 2px 3px 5px rgba(0,0,0,0.3);
        } 





    </style>
</head>
<body>
     <?php $page = '' ;
     require __DIR__ .'/../header.view.php';?>

        <?php foreach ($canteens as $canteen): ?>
   <div class="container">
    <div class="details">
    <div class="top"> <h1><?=$canteen?></h1> </div>
    <div class="middle">
        
            <div class="loc-details">
                <div>Ground Floor,Academic Block A</div>
                <div>8:00 AM - 6:00 PM</div>
                <div>$50-$200</div>
            </div>
            <div class="description">
                Spacious dining area with variety of South Indian, North Indian, 
                and Continental cuisines. 
                Known for fresh ingredients and hygienic preparation.
            </div>
       
    </div>
    <div class="bottom">
        <div>
            Rating 4.8/5 (1,247 reviews)
        </div>
    </div>
    </div>

    <div class="buttons">
      
       <a href="<?=ROOT?>students/canteen/<?=urlencode($canteen)?>"><button>VIEW</button></a> 
    </div>
   </div>

   <?php endforeach; ?>
</body>
</html>