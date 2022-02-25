function getGame(id){
    request(new RequestData("getGame", id.toString()), setGame);
}

function request(requestData, callback) {
    $.ajax({
        type: "GET",
        url: `api.php?action=${requestData.action}&value=${requestData.value}`,
        success: callback
    })
}

function setGame(game) {

    game = JSON.parse(game);

    document.getElementById("gameID").valueAsNumber = game.gameID;
    document.getElementById("gameName").value = game.gameName;
    document.getElementById("description").value = game.description;
    document.getElementById("releaseDate").valueAsDate = new Date(game.releaseDate * 1000);
    document.getElementById("price").value = game.price;
    document.getElementById("review").value = game.review;
    document.getElementById("wishlisted").checked = game.wishlisted;

    const categoryNames = [];
    game.categories.forEach(category => categoryNames.push(category.categoryName));
    document.getElementById("categories").value = categoryNames.join();
}

function getCategory(id){
    request(new RequestData("getCategory", id.toString()), setCategory)
}

function setCategory(category){

    category = JSON.parse(category);

    document.getElementById("categorieID").valueAsNumber = category.categoryID;
    document.getElementById("categoryName").value = category.categoryName;
    document.getElementById("deleted").checked = category.deleted;
}

function reload(){
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.location = window.location.href;
}

function getFormattedDate(timestamp) {
    const date = new Date(timestamp);
    return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
}