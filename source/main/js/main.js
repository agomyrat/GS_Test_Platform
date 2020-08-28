let sidebar_btn = document.getElementById('sidebar_btn')
let sidebar = document.getElementById('sidebar')
let icon = document.querySelector('.fa-th-list')

if (window.innerWidth <= 800) {
    sidebar.style.display = 'none'
}

sidebar_btn.addEventListener("click", function () {
    if (sidebar.style.display === 'none') {
        sidebar.style.display = 'block'
        let pos = -250

        if (sidebar.style.display === 'block') {
            icon.classList.remove('fa-th-list')
            icon.classList.add('fa-times')
        }

        let interval = setInterval(open, 5)
        function open() {
            if (pos >= 0) {
                clearInterval(interval);
            } else {
                console.log(pos)
                pos += 3;
                sidebar.style.left = pos + 'px';
            }
        }
    } else if (sidebar.style.display === 'block') {

        let interval = setInterval(close, 5)
        let pos = 0
        function close() {
            if (pos <= -250) {
                clearInterval(interval);
                sidebar.style.display = 'none'
                icon.classList.remove('fa-times')
                icon.classList.add('fa-th-list')
            } else {
                console.log(pos)
                pos -= 3;
                sidebar.style.left = pos + 'px';
            }
        }
    }
})