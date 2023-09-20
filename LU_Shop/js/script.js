const activePage = window.location.pathname;
const navLinks = document.querySelectorAll('nav a').forEach(link => {
    if (link.href.includes(`${activePage}`)) {
        link.classList.add("active");
        const title = link.title;
        let titletag = document.querySelector('title');
        titletag.innerHTML = title;
        console.log(title);
    }
});
