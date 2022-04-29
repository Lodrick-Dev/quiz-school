// const msgUser = document.querySelector(".")
let links = document.querySelectorAll(".link-watch-plus");
console.log(links);
if(links){
    links.forEach(link => { 
        link.addEventListener("click", (e)=>{
            if(!confirm("vous allez quitter cette page, Voulez vous vrament quitter ?")){
                e.preventDefault();
        return;
            }
        })
    });
}