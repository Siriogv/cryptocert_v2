const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    const toggleButton = document.getElementById('toggleButton');
    let state = 0; // 0: closed, 1: icons-only, 2: open

    toggleButton.addEventListener('click', () => {
        if (state === 0) {
            sidebar.classList.remove('closed');
            sidebar.classList.add('icons-only');
            sidebar.style.width = '60px';
            main.style.marginLeft = '60px';
            state = 1;
        } else if (state === 1) {
            sidebar.classList.remove('icons-only');
            sidebar.classList.add('open');
            sidebar.style.width = '250px';
            main.style.marginLeft = '250px';
            state = 2;
        } else {
            sidebar.classList.remove('open', 'icons-only');
            sidebar.style.width = '0';
            main.style.marginLeft = '0';
            state = 0;
        }
    });

    // Initialize as closed
    sidebar.style.width = '0';
    main.style.marginLeft = '0';