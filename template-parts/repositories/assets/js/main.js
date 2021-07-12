(function() {
    const search = document.getElementById("repositories_search");
    const url = 'https://api.github.com/search/repositories?q=';
    const client_id = '967f1f8b503cfc2540f9';
    const client_secret = 'ea7aa2e3ab0677b549fa3a5c23f8b70bcc083557';

    async function getRepository(repositories) {

        const reposResponse = await fetch(
            `${url}${repositories}&client_id=${client_id}&client_secret=${client_secret}&per_page=8`
        );

        const repos = await reposResponse.json();

        return repos;
    }

    function showRepos(repos) {
        const items = repos.items;

        console.log(items);
        let output = '';
        items.forEach(item => {
            output += `
            <div class="container">
                <img src="${item.owner.avatar_url}" class="card-img-top" alt="...">
                <h4 class="title">${item.full_name}</h4><br>
                <p>${item.description}</p>
                <a class="button" href="receive?user=${item.owner.login}" class="card-text">Access: 
                    ${item.owner.login}
                    </a>
            </div>`;

        });


        document.querySelector('.repository-list').innerHTML = output;
    }

    search.addEventListener('keyup', e => {
        const repository = e.target.value;

        if (repository.length > 0) {
            getRepository(repository).then(res => showRepos(res));
        }
    })
})()