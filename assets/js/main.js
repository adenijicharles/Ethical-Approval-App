function closeModal(){
	var modal = document.getElementById("modal");
	modal.style.display = 'none';
}

document.body.onkeydown = function(e){
	if(e.keyCode == 27){
		var modal = document.getElementById("modal");
		modal.style.display = "none";
	}
};

function openModal(){
	var modal = document.getElementById("modal");
	modal.style.display = 'block';	
}

function changePrice(arg){
	openModal();
	var sku = arg.getAttribute("data-id");
	var amount = arg.getAttribute("data-price");
	var skuField = document.getElementById("sku");
	var priceField = document.getElementById("price");
	skuField.value = sku;
	priceField.value = amount;
	console.log(amount);
	console.log(sku);
}

function changeStockStatus(arg){
	openModal();
	var sku = arg.getAttribute("data-id");
	var skuField = document.getElementById("sku");
	var amount = arg.getAttribute("data-price");
	var priceField = document.getElementById("price");
	skuField.value = sku;
	priceField.value = amount;
	console.log(amount);
	console.log(sku);	
}

function changeProductPrice(arg){
	var sku = arg.getAttribute("data-id");
	var skuField = document.getElementById("newsku");
	skuField.value = sku;
}

function loadOrderDetails(arg){
	openModal();
	var modalBody = document.getElementById("modal-content");
	var loader = document.getElementById("loader");
	var orderId = arg.getAttribute("data-order");
	var bVId = arg.getAttribute("data-id");
	var amountPaid = arg.getAttribute("data-paid");
	var customerId = arg.getAttribute("data-customer");
	var tellerNumber = arg.getAttribute("data-teller-number");
	console.log(orderId);

	var xhr = new XMLHttpRequest();
	var url = "handlers/order/getOrderDetails.php?orderId="+ orderId + "&&id=" + bVId +"&&customer=" + customerId + "&&amount-paid=" + amountPaid + "&&teller-number=" + tellerNumber;
	xhr.open("GET", url, true);
	xhr.onreadystatechange = function(){
		if(xhr.readyState === 4 && xhr.status === 200){
			var response = xhr.responseText;
			loader.style.display = "none";
			modalBody.innerHTML = response;
		}
	};
	xhr.send();
}

function showThis(arg){
	var getId = arg.getAttribute("id");
	var getBoxes = document.getElementsByClassName("tab-content");
	var count = getBoxes.length;
	for(var i = 0; i < count; i++){
		if(getId == "a"){
			getBoxes[0].style.display = "block";
			getBoxes[1].style.display = "none";
			getBoxes[2].style.display = "none";
			getBoxes[3].style.display = "none";
			getBoxes[4].style.display = "none";
		}else if(getId == "b"){
			getBoxes[0].style.display = "none";
			getBoxes[1].style.display = "block";
			getBoxes[2].style.display = "none";
			getBoxes[3].style.display = "none";
			getBoxes[4].style.display = "none";
		}else if(getId == "c"){
			getBoxes[0].style.display = "none";
			getBoxes[1].style.display = "none";
			getBoxes[2].style.display = "block";	
			getBoxes[3].style.display = "none";		
			getBoxes[4].style.display = "none";
		}else if(getId == "d"){
			getBoxes[0].style.display = "none";
			getBoxes[1].style.display = "none";
			getBoxes[2].style.display = "none";
			getBoxes[3].style.display = "block";
			getBoxes[4].style.display = "none";			
		}else if(getId == "e"){
			getBoxes[0].style.display = "none";
			getBoxes[1].style.display = "none";
			getBoxes[2].style.display = "none";
			getBoxes[3].style.display = "none";
			getBoxes[4].style.display = "block";			
		}else if(getId == "f"){
			getBoxes[0].style.display = "none";
			getBoxes[1].style.display = "none";
			getBoxes[2].style.display = "none";
			getBoxes[3].style.display = "none";
			getBoxes[4].style.display = "block";			
		}
	}
}

function calculatePrice(arg){
	var id = arg.getAttribute("data-id");
	var quantity = document.getElementById("quantity" + id).innerHTML;
	var price = document.getElementById("price" + id).value;
	var total = document.getElementById("total" +id);
	total.innerHTML = "&#8358;" + quantity * price;
}

// document.getElementById("tip").addEventListener("click", function(){
// 	var mobileMenu = document.getElementById("mobile");
// 	var marginLeft = mobileMenu.getAttribute("data-left");
// 	if(marginLeft === "-201px"){
// 		mobileMenu.style.marginLeft = "0px";
// 		mobileMenu.setAttribute("data-left","0px");
// 	} else if(marginLeft === "0px"){
// 		mobileMenu.style.marginLeft = "-201px";
// 		mobileMenu.setAttribute("data-left","-201px");
// 	}
// });
// 
// 
$(document).ready(function(){
	$('.tip').click(function(){
		var mobile = $(".mobile").css("margin-left");

		if(mobile == "-201px"){
			$(".mobile").animate({marginLeft: "0px"});
		}else{
			$(".mobile").animate({marginLeft: "-201px"});
		}		
	});
});