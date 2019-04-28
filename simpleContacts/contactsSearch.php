                   <div class="signup-panel criteria">

                        <p>Select the search criteria</p>

                        <form id="location">
                              <input class="choices" id="car" onclick ="criteriaSet('car')"  type="checkbox" name="locationSet" value="0"> Cardonald
                              <input class="choices" id="cly" onclick ="criteriaSet('cly')" type="checkbox" name="locationSet" value="1"> Clyde
                              <input class="choices" id="eas" onclick ="criteriaSet('eas')" type="checkbox" name="locationSet" value="2"> East
                              <input class="choices" id="nor" onclick ="criteriaSet('nor')" type="checkbox" name="locationSet" value="3"> North
                              <input class="choices" id="loc" onclick ="criteriaSet('loc')" type="checkbox" name="locationSet" value="4"> Locals
                        </form>

                        <form id="criteria">
                              <input class="specificCriteria" id="sc_first" onclick ="criteriaSet('f')"  type="radio" name="criteria" value="5"> First name
                              <input class="specificCriteria" id="sc_last" onclick ="criteriaSet('s')" type="radio" name="criteria" value="6"> Surname
                              <input class="specificCriteria" id="sc_title" onclick ="criteriaSet('t')" type="radio" name="criteria" value="7"> Title
                              <input class="specificCriteria" id="sc_dep" onclick ="criteriaSet('d')" type="radio" name="criteria" value="8"> Department
                              <input class="specificCriteria" id="sc_dir" onclick ="criteriaSet('n')" type="radio" name="criteria" value="9"> Tel No
                              <input class="specificCriteria" id="sc_mob" onclick ="criteriaSet('m')" type="radio" name="criteria" value="11"> Mobile
                        </form>


                        <hr>

                        <p>Now enter your search term. (For best results enter a minimum of two characters)<strong>.<br>As you type, results will appear</strong></p>

                        <form onsubmit="event.preventDefault();">
                            <input id="searchVal" type="text" onkeyup="showHint(this.value)">
                        </form>

                        <h3 id="searchLoc"></h3>
                        <table id="txtHint"></table>
                    </div>
