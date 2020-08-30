<div class="container">
        <div class="sidebar">
            <i class="fas fa-th-list" id="sidebar_btn"></i>
            <div class="wrapper" id="sidebar">
                <a href="test/constructor"><button class="create">Create a test</button></a>

                <div class="test_left">
                    <h4>My tests</h4>
                <?php 
                    $this->renderCard('card_left',6);
                ?>
                    <a href="#">See all</a>

                </div>
            </div>
        </div>
        <div class="tests">
            <div class="top_bar">
                <div class="search">
                    <form action="#">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" name="search" id="" placeholder="Search...">
                    </form>
                </div>
            </div>
            <div class="popular">
                <h1 class="heading">Popular Tests</h1>
                <div class="popular-wrapper">  

                <?php 
                    $this->renderCard('test_card',3);
                ?>

                </div>
            </div>
            <div class="recent">
                <h1 class="heading">Recent Added</h1>
                <div class="recent-wrapper">

                <?php 
                    $this->renderCard('test_card_min',6);
                ?>

                </div>
                <a href="" style="float: right;">see all</a>
            </div>
            <div class="faworite">
                <h1 class="heading">Faworite Tests</h1>
                <div class="faworite-wrapper">  
                    
                <?php 
                    $this->renderCard('test_card',2);
                ?>
                
                </div>
            </div>

                </div>
            </div>
        </div>
    </div>
