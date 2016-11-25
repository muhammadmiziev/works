window.Sort = {}

Sort.wrapReviews = document.getElementById('wrap_reviews');
Sort.byNameOrder = 1;
Sort.byEmailOrder = 0;
Sort.byTimeOrder = 1;

Sort.byName = function(){

    var items = this.getItems();

    function ASC(){
        items.sort(function(a, b){
            return a.dataset.name > b.dataset.name
        });
        Sort.renderResult(items)
    }

    function DESC(){
        items.sort(function(a, b){
            return a.dataset.name < b.dataset.name
        })
        Sort.renderResult(items)
    }

    if(!this.byNameOrder) DESC();
    else ASC();

    this.byNameOrder = this.byNameOrder ? 0 : 1;
}


Sort.byEmail = function(){
    var items = this.getItems();

    function ASC(){
        items.sort(function(a, b){
            return a.dataset.email > b.dataset.email
        });

        Sort.renderResult(items)
    }

    function DESC(){
        items.sort(function(a, b){
            return a.dataset.email < b.dataset.email
        })

        Sort.renderResult(items)
    }

    if(!this.byEmailOrder) DESC();
    else ASC();

    this.byEmailOrder = this.byEmailOrder ? 0 : 1;
}


Sort.byTime = function(){
    var items = this.getItems();


    function ASC(){
        items.sort(function(a, b){
            return a.dataset.time - b.dataset.time
        });

        Sort.renderResult(items)
    }

    function DESC(){
        items.sort(function(a, b){
            return b.dataset.time - a.dataset.time
        })

        Sort.renderResult(items)
    }

    if(!this.byTimeOrder) DESC();
    else ASC();

    this.byTimeOrder = this.byTimeOrder ? 0 : 1;
}

Sort.getItems = function() {
    var row = document.getElementsByClassName('col-sm');
    var items = []

    for (var i = 0; i < row.length; i++)
        items.push(row[i])

    return items;
}

Sort.renderResult = function(items) {
    this.wrapReviews.innerHTML = '';
    for (var i = 0; i < items.length; i++) {
        // items[i].classList.add('showReV'); // для animation
        this.wrapReviews.appendChild(items[i]);
    }

}
