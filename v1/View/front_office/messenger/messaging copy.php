<?php

if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params(0, '/', '', true, true);
    session_start();
  }

// Include database connection and profile controller
require_once __DIR__ . '/../../../Controller/profileController.php';
require_once __DIR__ . '/../../../Controller/friendshipsCon.php';
include_once __DIR__ . '/../../../Controller/user_con.php';

$friendshipC = new FriendshipCon("friendships");

// Initialize profile controller
$profileController = new ProfileC();
$userC = new userCon("user");

// Get profile ID from the URL
$profile_id = "";

if (isset($_SESSION['user id'])) {

  $user_id = htmlspecialchars($_SESSION['user id']);

  // Get profile ID from the URL
  $profile_id = $profileController->getProfileIdByUserId($user_id);

}else{
    if (isset($_GET['profile_id'])) {
        $profile_id = $_GET['profile_id'];
    }
}

// Fetch profile data from the database
$profile = $profileController->getProfileById($profile_id);

$user_friends = array();
$user_friends = $friendshipC->getFriends($profile_id);

//var_dump($user_friends);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./../../../front office assets\images\HireUp_icon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./../profiles_management/assets/css/tailwindcss-colors.css">
    <link rel="stylesheet" href="./../profiles_management/assets/css/messaging.css">
    <title>HireUp Chat</title>
</head>
<body>

    <?php 
        $block_call_back = 'false';
        $access_level = "else";
        include('./../../../View/callback.php')  
    ?>

    <!-- start: Chat -->
    <section class="chat-section">
        <div class="chat-container">
            <!-- start: Sidebar -->
            <aside class="chat-sidebar">
                <a title="#" href="#" class="chat-sidebar-logo">
                    <i class="ri-chat-1-fill"></i>
                </a>
                <ul class="chat-sidebar-menu">
                    <li class="active"><a title="#" href="#" data-title="Chats"><i class="ri-chat-3-line"></i></a></li>
                    <li><a title="#" href="#" data-title="Contacts"><i class="ri-contacts-line"></i></a></li>
                    <li><a title="#" href="#" data-title="Documents"><i class="ri-folder-line"></i></a></li>
                    <li><a title="#" href="#" data-title="Settings"><i class="ri-settings-line"></i></a></li>
                    <li class="chat-sidebar-profile">
                        <button title="#" type="button" class="chat-sidebar-profile-toggle">
                            <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" alt="<?= $profile['profile_first_name'] ?>">
                        </button>
                        <ul class="chat-sidebar-profile-dropdown">
                            <li><a href="./../profiles_management/profile.php?profile_id=<?php echo $profile['profile_id'] ?>"><i class="ri-user-line"></i> Profile</a></li>
                            <li><a href="./../Sign In & Sign Up/logout.php"><i class="ri-logout-box-line"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- end: Sidebar -->
            <!-- start: Content -->
            <div class="chat-content">
                <!-- start: Content side -->
                <div class="content-sidebar">
                    <div class="content-sidebar-title">Chats</div>
                    <form action="" class="content-sidebar-form">
                        <input type="search" class="content-sidebar-input" placeholder="Search...">
                        <button title="#" type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
                    </form>
                    <div class="content-messages">
                        <ul class="content-messages-list">
                            <li class="content-message-title"><span>Recently</span></li>
                            
                            <?php
                            foreach ($user_friends as $user_friend) {
                                $i = 1;

                                // Fetch profile data from the database
                                $current_profile = $profileController->getProfileById($user_friend);
                                //var_dump($current_profile);
                                $current_user = $userC->getUser($current_profile['profile_userid']);

                            ?>

                                <li>
                                    <a href="#" data-conversation="#conversation-<?php echo $i; ?>">
                                        <img class="content-message-image" src="data:image/jpeg;base64,<?= base64_encode($current_profile['profile_photo']) ?>" alt="">
                                        <span class="content-message-info">
                                            <!-- <span class="content-message-name"><?php //echo $current_user['user_name']; ?></span> -->
                                            <span class="content-message-name"><?php echo $current_profile['profile_first_name'] . " " . $current_profile['profile_family_name']; ?></span>
                                            <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                                        </span>
                                        <span class="content-message-more">
                                            <span class="content-message-unread">5</span>
                                            <span class="content-message-time">12:30</span>
                                        </span>
                                    </a>
                                </li>

                            <?php

                                $i = $i + 1;

                            }
                            
                            ?>

                            <li>
                                <a href="#" data-conversation="#conversation-1">
                                    <img class="content-message-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                    <span class="content-message-info">
                                        <span class="content-message-name">Someone</span>
                                        <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                                    </span>
                                    <span class="content-message-more">
                                        <span class="content-message-unread">5</span>
                                        <span class="content-message-time">12:30</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-conversation="#conversation-2">
                                    <img class="content-message-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                    <span class="content-message-info">
                                        <span class="content-message-name">Someone</span>
                                        <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                                    </span>
                                    <span class="content-message-more">
                                        <span class="content-message-time">12:30</span>
                                    </span>
                                </a>
                            </li>

                        </ul>
                        <ul class="content-messages-list">
                            <li class="content-message-title"><span>Recently</span></li>
                            <li>
                                <a href="#">
                                    <img class="content-message-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                    <span class="content-message-info">
                                        <span class="content-message-name">Someone</span>
                                        <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                                    </span>
                                    <span class="content-message-more">
                                        <span class="content-message-unread">5</span>
                                        <span class="content-message-time">12:30</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="content-message-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                    <span class="content-message-info">
                                        <span class="content-message-name">Someone</span>
                                        <span class="content-message-text">Lorem ipsum dolor sit amet consectetur.</span>
                                    </span>
                                    <span class="content-message-more">
                                        <span class="content-message-time">12:30</span>
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- end: Content side -->
                <!-- start: Conversation -->
                <div class="conversation conversation-default active">
                    <i class="ri-chat-3-line"></i>
                    <p>Select chat and view conversation!</p>
                </div>
                <div class="conversation" id="conversation-1">
                    <div class="conversation-top">
                        <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                        <div class="conversation-user">
                            <img class="conversation-user-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                            <div>
                                <div class="conversation-user-name">Someone</div>
                                <div class="conversation-user-status online">online</div>
                            </div>
                        </div>
                        <div class="conversation-buttons">
                            <button type="button"><i class="ri-phone-fill"></i></button>
                            <button type="button"><i class="ri-vidicon-line"></i></button>
                            <button type="button"><i class="ri-information-line"></i></button>
                        </div>
                    </div>
                    <div class="conversation-main">
                        <ul class="conversation-wrapper">
                            <div class="coversation-divider"><span>Today</span></div>
                            <li class="conversation-item me">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet natus repudiandae quisquam sequi nobis suscipit consequatur rerum alias odio repellat!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, tenetur!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque eos ab in?</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, debitis. Iste natus est aliquam ipsum doloremque fugiat, quidem eos autem? Dolor quisquam laboriosam enim cum laborum suscipit perferendis adipisci praesentium.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item me">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas, eos, magni temporibus, placeat consectetur nobis incidunt dicta a culpa vel esse. Facilis fugiat possimus eveniet accusamus dignissimos pariatur inventore animi rem vero, eligendi obcaecati fugit quaerat? Officia ex quod eaque maxime ipsam, tempore error laboriosam laborum, magnam ipsum doloremque quas.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Temporibus debitis odio maiores perferendis ipsa repudiandae amet blanditiis quod. Ullam, dolorum.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium blanditiis ea, voluptatum, eveniet at harum minima maxime enim aut non, iure expedita excepturi tempore nostrum quasi natus voluptas dolore ducimus!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="conversation-form">
                        <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                        <div class="conversation-form-group">
                            <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>
                            <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                        </div>
                        <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                    </div>
                </div>
                <div class="conversation" id="conversation-2">
                    <div class="conversation-top">
                        <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                        <div class="conversation-user">
                            <img class="conversation-user-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                            <div>
                                <div class="conversation-user-name">Someone 1</div>
                                <div class="conversation-user-status online">online</div>
                            </div>
                        </div>
                        <div class="conversation-buttons">
                            <button type="button"><i class="ri-phone-fill"></i></button>
                            <button type="button"><i class="ri-vidicon-line"></i></button>
                            <button type="button"><i class="ri-information-line"></i></button>
                        </div>
                    </div>
                    <div class="conversation-main">
                        <ul class="conversation-wrapper">
                            <div class="coversation-divider"><span>Today</span></div>
                            <li class="conversation-item me">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet natus repudiandae quisquam sequi nobis suscipit consequatur rerum alias odio repellat!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, tenetur!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque eos ab in?</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, debitis. Iste natus est aliquam ipsum doloremque fugiat, quidem eos autem? Dolor quisquam laboriosam enim cum laborum suscipit perferendis adipisci praesentium.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item me">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8cGVvcGxlfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas, eos, magni temporibus, placeat consectetur nobis incidunt dicta a culpa vel esse. Facilis fugiat possimus eveniet accusamus dignissimos pariatur inventore animi rem vero, eligendi obcaecati fugit quaerat? Officia ex quod eaque maxime ipsam, tempore error laboriosam laborum, magnam ipsum doloremque quas.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Temporibus debitis odio maiores perferendis ipsa repudiandae amet blanditiis quod. Ullam, dolorum.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium blanditiis ea, voluptatum, eveniet at harum minima maxime enim aut non, iure expedita excepturi tempore nostrum quasi natus voluptas dolore ducimus!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="conversation-form">
                        <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                        <div class="conversation-form-group">
                            <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>
                            <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                        </div>
                        <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                    </div>
                </div>
                <!-- end: Conversation -->
            </div>
            <!-- end: Content -->
        </div>
    </section>
    <!-- end: Chat -->
    
    <script src="./../profiles_management/assets/js/messaging.js"></script>
</body>
</html>