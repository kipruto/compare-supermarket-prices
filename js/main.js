var $ = jQuery.noConflict();

(function($) {
    "use strict";


$(document).ready(function () {
  /* Check width on page load*/
  if ($(window).width() < 993) {
    $('.menu-button').addClass('hide'); 
  }
  else { }
});

$(window).resize(function () {
  /*If browser resized, check width again */
  if ($(window).width() < 993) {
    $('.menu-button').removeClass('hide');
  }
  else { 
    $('.menu-button').addClass('hide'); 
  }
});

$(function () {
  var hasBeenTrigged = false;
  $(window).scroll(function () {
    if ($(this).scrollTop() >= 100 && !hasBeenTrigged) { // if scroll is greater/equal then 100 and hasBeenTrigged is set to false.
      $('nav').addClass('small-nav'); 
      hasBeenTrigged = true;
    } else if ($(this).scrollTop() <= 100 && hasBeenTrigged) {
      $('nav').removeClass('small-nav');
      hasBeenTrigged = false;
    }
  });
});
//Toogle Mobile Menu
$(".menu-button").click(function () {
  $('.menu').toggleClass('slide');
});



    // ================================
// Shopping Cart API
// ================================

var shoppingCart = (function() {
  // =============================
  // Private methods and propeties
  // =============================
  var cart = [];
  
  // Constructor
  function Item(image, name, price, pid,  count) {
    this.name = name;
    this.image = image;
    this.price = price;
    this.pid = pid;
    this.count = count;
  }
      
    // Save cart
    function saveCart() {
      sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }
    
      // Load cart
    function loadCart() {
      cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
      loadCart();
    }
    
  
// =============================
// Public methods and propeties
// =============================
var obj = {};

// Add to cart
obj.addItemToCart = function(image, name, price, pid, count) {
  for(var item in cart) {
    if(cart[item].pid === pid) {
      cart[item].count ++;
      saveCart();
      return;
    }
  }
  var item = new Item(image, name, price, pid, count);
  cart.push(item);
  saveCart();
}
// Set count from item
obj.setCountForItem = function(pid, count) {
  for(var i in cart) {
    if (cart[i].pid === pid) {
      cart[i].count = count;
      break;
    }
  }
};
// Remove item from cart
obj.removeItemFromCart = function(pid) {
    for(var item in cart) {
      if(cart[item].pid === pid) {
        cart[item].count --;
        if(cart[item].count === 0) {
          cart.splice(item, 1);
        }
        break;
      }
  }
  saveCart();
}

// Increment item in cart
obj.Increment = function(pid) {
    for(var item in cart) {
      if(cart[item].pid === pid) {
        cart[item].count ++;
        saveCart();
        return;
      }
}
}

// Remove all items from cart
obj.removeItemFromCartAll = function(pid) {
  for(var item in cart) {
    if(cart[item].pid === pid) {
      cart.splice(item, 1);
      break;
    }
  }
  saveCart();
}

// Clear cart
obj.clearCart = function() {
  cart = [];
  saveCart();
}

// Count cart 
obj.totalCount = function() {
  var totalCount = 0;
  for(var item in cart) {
    totalCount += cart[item].count;
  }
  return totalCount;
}

// Total cart
obj.totalCart = function() {
  var totalCart = 0;
  for(var item in cart) {
    totalCart += cart[item].price * cart[item].count;
  }
  return Number(totalCart.toFixed(2));
}

// List cart
obj.listCart = function() {
  var cartCopy = [];
  for(var i in cart) {
   var item = cart[i];
    var itemCopy = {};
    for(var p in item) {
      itemCopy[p] = item[p];

    }
    itemCopy.total = Number(item.price * item.count).toFixed(2);
    cartCopy.push(itemCopy)
  }
  return cartCopy;
}


return obj;
})();


// =====================================
// Triggers Events
// =====================================


// Add item from comparison page

$('.savecart').click(function(event) {
  var pid = $(this).data('pid');
  var price = Number($(this).data('price'));
  var image = $(this).data('image');
  var name = $(this).data('name');
shoppingCart.addItemToCart(image, name , price,  pid, 1);
event.preventDefault();
displayCart();
});


// Add item from main product page

$('.bbtn').click(function(event) {

  var pid = $(this).data('pid');
  var price = Number($(this).data('price'));
  var image = $(this).data('image');
  var name = $(this).data('name');
  shoppingCart.addItemToCart(image, name , price,  pid, 1);
  event.preventDefault();
  displayCart();
  });
  

// Delete item button
$('.cartdropdownbox').on('click',  '.fas.fa-times', function(event) {
    event.preventDefault();
    var pid = $(this).closest('.tr_item').find('#remove').data('pid');
  shoppingCart.removeItemFromCartAll(pid);
  displayCart();
});

// Delete item button

var delay=1000;
$('.btn-cart-box').hover(function() {
  $('.cartdropdownbox').addClass('displayit');
}, function() {
  setTimeout(function() { 
    $('.cartdropdownbox').removeClass('displayit');
}, 2000);


});

// Clear items
$('.clear-cart').click(function() {
shoppingCart.clearCart();
displayCart();
});


function displayCart() {
var cartArray = shoppingCart.listCart();
var output = "";
var output2 = "";

for(var i in cartArray) {


output += "<div class='tr_item'>"
+ "<div class='td_item'>"
  + "<img src='"+ cartArray[i].image +"' />"
+ "</div>"
+ "<div class='td_item item_name'>"
 + " <label class='main'>" + cartArray[i].name + "</label>"
+ "</div>"
+ "<div class='td_item item_color'>"
+ "<label> € "+ cartArray[i].price +" </label>"
+ "</div>"
+ "<div class='td_item item_remove'>"
 + " <span class='material-icons-outlined'>" + "<i type='submit' class='fas fa-times' id='remove' data-pid="+cartArray[i].pid+">"+"</i>"+"</span>"
+ "</div>"
+ "</div>";

}

if(cartArray.length === 0) {
  
  output2 += "<div class='empty__cart'>"
      +"<p><i  class='fas fa-shopping-bag mr-3'></i> Your basket is empty</p>"
    +"</div>";


}
if(cartArray.length > 0) {
    output += "<div class='total-btn-wrapper' >"
    + "<div class='ttotal'>"
    + "<p class='shopping_total'>Total €:  <strong class='ctotal'>  </strong>.00</p>"
    + "</div>"

}

$('.cartdropdownbox').html(output);
// $('.cartdropdown-box').html(output2);
$('.ctotal').html(shoppingCart.totalCart());
$('.itemsincart').html(shoppingCart.totalCount());
}

// -1
$('.cart-dropdown').on('click', '.minus-item', function(event) {
var pid = $(this).data('pid');
shoppingCart.removeItemFromCart(pid);
displayCart();
event.preventDefault()
})
// +1
$('.cart-dropdown').on('click', ".plus-item", function(event) {
var pid = $(this).data('pid');
shoppingCart.Increment(pid);
displayCart();
event.preventDefault()
})


// -1
$('.table4-responsive').on('click', '.minus-item', function(event) {
var pid = $(this).data('pid');
shoppingCart.removeItemFromCart(pid);
displayCart();
event.preventDefault()
})
// +1
$('.table4-responsive').on('click', ".plus-item", function(event) {
var pid = $(this).data('pid')
shoppingCart.Increment(pid);
displayCart();
event.preventDefault()
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
 var pid = $(this).data('pid');
 var count = Number($(this).val());
shoppingCart.setCountForItem(pid, count);
displayCart();
});

displayCart();


$("#hide_button").click(function() {

  $("#calculatorAge").val('');
  $("#calculatorWeight").val('');
  $("#calculatorHeight").val('');
  document.getElementById('displayResults').style.display = 'none';

})

$("#calculate_button").click(function() {
                var radio_gender = $("input[name='check']:checked").val();
                var calculatorAge = $("#calculatorAge").val();
                var calculatorWeight = $("#calculatorWeight").val();
                var calculatorHeight = $("#calculatorHeight").val();
                var activity = $("#activity").val();
              
                if (calculatorAge == "" || calculatorWeight == "" || calculatorHeight == "") {
                    alert("All fields are required");
                } else {

                    calculatorAge = parseInt(calculatorAge);
                    calculatorWeight = parseInt(calculatorWeight);
                    calculatorHeight = parseInt(calculatorHeight);

                    calculate_brm(radio_gender, calculatorWeight, calculatorHeight, calculatorAge, activity);
                }

                // function calculate BMR

                function calculate_brm(radio_gender, calculatorWeight, calculatorHeight, calculatorAge, activity) {

                    if (radio_gender == "male") {
                        var this_constant_1 = 655.1;
                        var this_constant_2 = 9.563;
                        var this_constant_3 = 1.850;
                        var this_constant_4 = 4.676;

                    } else {
                        var this_constant_1 = 66.47;
                        var this_constant_2 = 13.75;
                        var this_constant_3 = 5.003;
                        var this_constant_4 = 6.755;
                    }

                    // get the bmr
                    var this_bmr = this_constant_1 + (this_constant_2 * calculatorWeight) + (this_constant_3 * calculatorHeight) - (this_constant_4 * calculatorAge);
                    // calculate amr     <a href='compare.php?id=$id' id='recommend_view'>View</a>
                    calculate_amr(this_bmr, activity);
                }

                function calculate_amr(this_bmr, activity) {

                    switch (activity) {
                        case "1.2":
                            var this_amr = this_bmr * 1.2;
                            break;
                        case "1.3":
                            var this_amr = this_bmr * 1.375;
                            break;
                        case "1.5":
                            var this_amr = this_bmr * 1.55;
                            break;
                        case "1.8":
                            var this_amr = this_bmr * 1.725;
                            break;
                        case "2.2":
                            var this_amr = this_bmr * 1.9;
                            break;
                        default:
                            // statements_def
                            break;
                    }
                    // alert the amr
                    var amr_round = Math.round(this_amr);
                    $.post("recommend.php", {
                        amr_round: amr_round
                    }, function(data) {
                        $("#header_text").html(data);
                    })
                }
              })
})(jQuery);