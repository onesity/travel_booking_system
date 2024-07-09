window.addEventListener('load', () => {
    const card_deck = document.querySelector('.card-deck');
    const search = document.getElementById('search');
    const total_records = document.getElementById('total_records');
    if (search.value == '') {
        card_deck.innerHTML = '';
        const get_all_records_parameters = {
            action: 'get_all_travel_records',
            search_key: search.value
        }
        fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
            method: 'POST',
            headers: {
                'Contenyt-Type': 'application/json'
            },
            body: JSON.stringify(get_all_records_parameters)
        }).then((res) => {
            return res.json();
        }).then((res) => {
            if (res.success == true) {
                total_records.innerText = res.total_records + ' : records found';
                if (res.total_records != 0) {
                    printCards(res.data)
                } else {
                    noDataFound()
                }
            } else {

            }
        })
    }

    search.addEventListener('keyup', () => {
        card_deck.innerHTML = '';
        const get_all_records_parameters = {
            action: 'get_all_travel_records',
            search_key: search.value
        }
        fetch('http://localhost/travel_booking_system/travel_booking_system/html/ajax.php', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(get_all_records_parameters)
        }).then((r) => {
            return r.json();
        }).then((res) => {

            const card_deck = document.querySelector('.card-deck');
            total_records.innerText = res.total_records + ' : records found';
            if (res.success == true) {
                if (res.total_records != 0) {
                    printCards(res.data)
                } else {
                    noDataFound()
                }
            } else {

            }
        })
    })

})


function printCards(data) {
    const card_deck = document.querySelector('.card-deck');
    card_deck.innerHTML = '';
    data.forEach((e) => {

        let id = e.id;
        let title = e.title;
        let description = e.description;
        let image = e.image;
        let days = e.days;
        let price = e.price;


        const card_body = `
               <div class="main_card_body">
                <a href="../html/details.php?id=${id}" id="card_image_link"> 
                <img class="card-img-top" id="card_image" src="../${image}" alt="Card image cap">
                </a>
         
                <div class="card-body">
                    <h5 class="card-title">${title}</h5>
                    <p class="card-text">${description}</p>
                </div>

                <div>
                <span id="price-tag"><i class="fa fa-inr" aria-hidden="true"></i> ${price}</span>
                    <a href='checkout.php?id=${id}' class="btn btn-primary">Book Now</a>
                </div>
                </div>`;

        const card = document.createElement('div');
        card.setAttribute('class', 'card');
        card.innerHTML = card_body;
        card_deck.append(card);

    })
}

function noDataFound() {
    const card_deck = document.querySelector('.card-deck');
    card_deck.innerHTML = '';
    let image = document.createElement("img");
    image.setAttribute("id", 'nodatafoundimage');
    image.setAttribute("src", 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS29r8OXq7Pu4yHapdH-HCxpDOAjDIMrtd3ag&s');
    card_deck.appendChild(image);
}
