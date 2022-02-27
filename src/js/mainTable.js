async function getImages(gameCount){

    const imageRequest = new RequestData("getImage", "");

    for (let i = 0;i < gameCount;i++){

        const elementID = `image${i}`;

        if(document.getElementById(elementID) != null){

            const element = document.getElementById(elementID);
            imageRequest.value = element.dataset.name;

            request(imageRequest, (src) => {

                let image;

                if(src.length > 0) {
                    image = document.createElement("img");
                    image.src = src;
                    image.width = 52;
                    image.height = 72;
                }else {
                    image = document.createElement("span");
                    image.innerText = "No image found";
                }

                element.innerHTML = "";
                element.appendChild(image);
            });

            await sleep(250);
        }
    }

    $('.datatable').DataTable();
}

function sleep(ms) {
    return new Promise((resolve) => {
        setTimeout(resolve, ms);
    });
}

function switchFavorite(id){

    const switchRequest = new RequestData("switchFavorite", id);
    request(switchRequest, reload);

    const button = document.getElementById(`favorButton${id}`);
    button.innerHTML = "";
    button.appendChild(spinner);

}

function deleteGame(id){
    if(window.confirm("Do you really want to delete this game?")) {

        const deleteRequest = new RequestData("deleteGame", id);
        request(deleteRequest, reload);

        const button = document.getElementById(`deleteButton${id}`);
        button.innerHTML = "";
        button.appendChild(spinner);

    }
}

function search(query){
    $(".dataTable").DataTable().search(query).draw();
}