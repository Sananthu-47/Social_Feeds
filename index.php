<?php require "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php 
    if(!isset($_SESSION['username']))
    {
        header("Location: login.php");
    }
?>
<div class="w-100 d-flex justify-content-center">
    <div class="card bg-light d-none d-md-flex col-3 p-0">
    <div class="d-flex justify-content-center">
        <?php include "includes/home-page-user.php"; ?>
    </div>
    </div>

    <div class="card bg-light col-12 col-md-6 p-0">
    <div class="content">
        <?php include "includes/say-something.php"; ?>
        <hr>
        <?php getAllPosts(); ?>
    </div>
    </div>

    <div class="card bg-light d-none d-md-flex col-3 p-0">
    <div class="">
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt qui dicta odio a facere? Dolores eaque asperiores quod, quas assumenda quia explicabo dicta autem porro repellendus, quis velit cupiditate harum?
    A atque illum ex laudantium iste consequuntur vel, consequatur laborum deserunt illo provident est quibusdam magnam eos ut maiores sit necessitatibus voluptate. Obcaecati hic unde, alias a soluta cumque omnis?
    Vitae excepturi eligendi corrupti, repudiandae natus repellat harum impedit architecto dolor nulla modi debitis hic officiis! Eligendi officia velit unde exercitationem facere illum sed illo. Corporis aperiam doloremque laborum qui.
    Minima voluptatem voluptatibus dicta id consectetur corrupti nesciunt ex quod aliquam aperiam veritatis, enim esse quis excepturi quidem nisi at! Sapiente quos quasi ipsa rem voluptas? Nulla sit deserunt eligendi!
    Tempore, nobis recusandae voluptatum quos mollitia provident exercitationem ipsam eligendi, maiores, voluptatem a magnam molestiae quod nemo explicabo iste totam assumenda architecto. Aliquid tenetur possimus earum in placeat, nulla sapiente.
    Minima odio suscipit quia omnis, porro odit magnam at impedit hic aliquam in unde consectetur amet tenetur doloribus itaque iste temporibus animi quisquam natus! Adipisci perferendis non ducimus laboriosam magnam!
    Laborum ab beatae asperiores, esse fugit praesentium vel quidem eaque nesciunt, dolorum ipsam modi facilis placeat adipisci deleniti reiciendis aut excepturi repudiandae saepe. Vero, possimus mollitia ab placeat quia eos!
    Nesciunt inventore similique temporibus nulla atque! Unde, odio libero quod neque alias beatae cum tenetur quis itaque fuga esse voluptate architecto sequi necessitatibus quos eos quidem blanditiis illo similique nesciunt!
    Adipisci eaque laudantium quam, ipsum beatae voluptatibus deleniti molestiae officiis. Corporis eveniet est, accusamus ducimus eaque dicta, blanditiis ab ut iure repellendus autem dolores consequatur molestiae voluptatum numquam aliquam. Facilis.
    Suscipit veniam, reprehenderit neque velit aspernatur omnis? Molestias itaque optio ab nulla, alias, ducimus, saepe veniam aut possimus quas dolores dolorum asperiores perspiciatis. Fugiat praesentium, laborum quia non necessitatibus reprehenderit!
    </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>