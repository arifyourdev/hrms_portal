<?php $contact = Contact::find_by_single_contact();?>
<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
        <div class="footer-static-top">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer__widget footer__menu">
                             <div class="footer__content f-logo">
                               <img src="img/madhubun-white-logo.svg" alt="logo images">
                                 <p class="text-white mt-3">
                                      <?php echo $contact->address?> <br>
                                     Landline: <?php echo $contact->landline?> <br>
                                     Fax: <?php echo $contact->fax?> <br>
                                     Email:<?php echo $contact->email?>
                                 </p>
                              </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer__widget footer__menu">
                              <!--<h4 class="text-white cont-map-text">CONTACT US</h4>-->
                             <div class="footer__content fc mt-2">
                                 <img src="img/world-map.svg" alt="logo images">
                              </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-3">
                        <div class="footer__widget footer__menus">
                             <div class="footer__contents">
                                 <h4 class="text-white">USEFUL LINKS</h4>
                                 <div class="d-flexss">
                                 <ul>
                                    <li><a href="publisher-warranty">Publisher's Warranty</a></li>
                                    <li><a href="how-to-order">How to Order</a></li>
                                    <li><a href="publish-with-us" target="blank">Publish With Us</a></li>
                                    <li><a href="work-with-us">Work With Us</a></li>
                                    <li><a href="workspace">Employee Workspace</a></li>
                                    <li><a href="contact-us">Contact Us</a></li>
                                    <!-- <li><a href="career">Career</a></li> -->
                                    <!--<li><a href="">Privacy & Cookie Policy</a></li>-->
                                    <!--<li><a href="">Terms and condition</a></li>-->
                                 </ul>
                                  </div>
                              </div>
                               
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="copyright__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="copyright">
                            <div class="copy__right__inner text-start">
                                <div class="row text-center">
                                     <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="f-bottom">
                                            <a href="faq">FAQs</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="f-bottom">
                                            <a href="privacy-policy">Privacy & Cookie Policy</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <div class="f-bottom">
                                             <a href="terms-and-conditions">Terms and Condition</a>
                                        </div>
                                    </div>
                                      <div class="col-lg-1 col-md-12 col-sm-12">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </footer>