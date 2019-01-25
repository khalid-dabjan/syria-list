<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package syria_list
 */

get_header();

$cities = getCities();
//var_dump( $cities );
$categories = getCategories();

?>
    <section class="bg-grey-lighter shadow">
        <div class="container mx-auto py-10 px-3 lg:px-0">
            <form id="search_form">
                <input type="hidden" name="action" value="sl_search">
                <div class="flex items-center justify-between flex-wrap flex-col lg:flex-row">
                    <div class="w-full flex justify-around mb-5">
                        <div class="w-full flex justify-between items-center shadow">
                            <input name="s" placeholder="What are you looking for?"
                                   class="search-field py-3 px-5 w-full rounded-lg"
                                   value="<?php echo get_search_query() ?>">
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 mb-5">
                        <div class="lg:mr-3">
                            <div class="flex justify-between items-center bg-white py-3 rounded-lg shadow">
                                <div class="w-1/2">
                                    <div class="flex justify-around items-center border-r border-blue">
                                        <input type="radio" name="type" value="partners" id="partners"
                                               class="search-field radio"
                                               checked>
                                        <label for="partners"
                                               class="font-thin mr-2"><?php _e( 'Partners Only', 'syria_list' ) ?></label>
                                    </div>
                                    <!--                                    <label for="partners">-->
                                    <!--                                        <i class="fa fa-handshake text-lg text-blue"></i>-->
                                    <!--                                    </label>-->
                                </div>
                                <div class="w-1/2">
                                    <div class="flex justify-around items-center">
                                        <input type="radio" name="type" value="all" id="all"
                                               class="search-field radio">
                                        <label for="all"
                                               class="font-thin mr-2"><?php _e( 'Show All', 'syria_list' ) ?></label>
                                    </div>
                                    <!--                                    <label for="all">-->
                                    <!--                                        <i class="fa fa-list-ul text-lg text-blue"></i>-->
                                    <!--                                    </label>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 mb-5">
                        <div class="lg:mr-3">
                            <select name="categories[]" multiple="multiple"
                                    class="search-field select2-multiple w-full shadow rounded-lg text-grey-darkest">
                                <<?php foreach ( $categories as $category ): ?>
                                    <optgroup label="<?php echo $category->name ?>">
										<?php foreach ( $category->children as $child ): ?>
                                            <option value="<?php echo $child->term_id ?>"><?php echo $child->name ?></option>
										<?php endforeach; ?>
                                    </optgroup>
								<?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 mb-5">
                        <div class="">
                            <select name="city" class="search-field select2-single shadow rounded-lg w-full">
                                <option value=""><?php _e( 'All', 'syria_list' ) ?></option>
								<?php foreach ( $cities as $city ): ?>
                                    <option value="<?php echo $city->term_id ?>"><?php echo $city->name ?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="offset" value="0" id="offset_input">
            </form>
        </div>
    </section>

    <section class="my-6">
        <div class="container mx-auto">

            <div class="hidden" id="loading">
                <div class="flex justify-around">
                    <div class="lds-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>

            <div class="hidden" id="no_result">
                <div class="flex justify-around py-32">
                    <p class="text-2xl text-blue"><?php _e( 'No results were found.', 'syria_list' ) ?></p>
                </div>
            </div>

            <div class="" id="results">
                <div class="flex flex-wrap my-5 -mx-2" id="results_append">

                </div>

                <div class="flex justify-around">
                    <button id="see_more"
                            class="py-2 px-4 border border-blue shadow no-underline text-blue hover:text-white hover:bg-blue hover:font-thin">
                        See more
                    </button>
                </div>
            </div>


            <!--            <div class="flex justify-around navigation">-->
            <!--				--><?php //posts_nav_link( ' ' ) ?>
            <!--            </div>-->

        </div>
    </section>

    <!--    <section class="my-6">-->
    <!--        <div class="container mx-auto">-->
    <!---->
    <!--            <div class="flex flex-wrap my-5 -mx-2">-->
    <!---->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus3.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">IGym</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!---->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Health</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Gyms</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus4.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">Tala Fashion For Women</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Fashion</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Women</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus3.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">IGym</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!---->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Health</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Gyms</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus4.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">Tala Fashion For Women</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Fashion</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Women</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus4.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">Tala Fashion For Women</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Fashion</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Women</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus3.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">IGym</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                                et perferendis eaque, exercitationem praesentium nihil.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!---->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Health</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Gyms</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus4.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">Tala Fashion For Women</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Fashion</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Women</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="w-1/4 px-2 pb-3">-->
    <!--                    <div class="rounded overflow-hidden shadow-md hover:shadow-lg bg-white">-->
    <!--                        <img class="w-full business-image"-->
    <!--                             src="images/bus4.jpg"-->
    <!--                             alt="Sunset in the mountains">-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <div class="font-bold text-xl mb-2 truncate">Tala Fashion For Women</div>-->
    <!--                            <p class="text-grey-darker text-base h-16 overflow-hidden">-->
    <!--                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla!-->
    <!--                                Maiores-->
    <!--                                et perferendis eaque, exercitationem praesentium.-->
    <!--                            </p>-->
    <!--                        </div>-->
    <!--                        <div class="px-6 py-4">-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Partners</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Fashion</a>-->
    <!--                            <span class="text-sm text-grey mr-1 fa fa-angle-right"></span>-->
    <!--                            <a href="#" class="text-grey-darker no-underline mr-1 hover:underline">Women</a>-->
    <!---->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!---->
    <!--            </div>-->
    <!---->
    <!--            <div class="flex justify-around">-->
    <!--                <a href="#"-->
    <!--                   class="py-2 px-4 border border-blue shadow no-underline text-blue hover:text-white hover:bg-blue hover:font-thin">See-->
    <!--                    more</a>-->
    <!--            </div>-->
    <!---->
    <!--        </div>-->
    <!--    </section>-->
<?php
get_sidebar();
get_footer();
