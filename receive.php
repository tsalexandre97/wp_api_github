<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

?>

<script>
    const urlParam = new URLSearchParams(window.location.search);
    const userGitHub = urlParam.get('user');

    const url = `https://api.github.com/users/${userGitHub}/repos`;

    async function getUser(getUrl) {

        const reposResponse = await fetch(getUrl);

        const repos = await reposResponse.json();

        return repos;
    }


    function showRepos(repos) {

        const header1 = document.getElementById('title_main');
        header1.innerText = userGitHub;
        const items = repos;

        let output = '';
        items.forEach(item => {
            output += `
            <br><p><span>Repository:</span> ${item.full_name}</p>
            <a target="_blank" href="${item.html_url}"><span>URL:</span> ${item.html_url}</a>
            <p><span>Description:</span> ${item.description}</p><br>        
            <hr>`;

        });


        document.querySelector('.gitUser').innerHTML = output;
    }

    getUser(url).then(res => showRepos(res)).catch(err => console.log(err))
</script>

<div class="default-max-width">
    <h1 id="title_main"></h1>

    <div class="gitUser">
        ...Loading
    </div>
</div>

<?php get_footer(); ?>