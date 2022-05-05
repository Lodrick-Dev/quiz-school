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




/////
// const x = document.getElementById("display-questionnary");
// const y = document.querySelector(".box-boucl");
// console.log(y);
// console.log(x);
// x.addEventListener('click', ()=>{
//     // alert("yedgcfsn");
// })
// y.addEventListener('click', ()=>{
//     console.log("Click");;
// })