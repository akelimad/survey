<table  width="100%">

                    <td  width="30%">

                        <table width="100%" border="0">

                            <tr>

                              <td colspan="2" ><label>Par mot clé</label><br/>

                                  <input  type="text" name="motcle" style="width:185px" 

                                  placeholder="mot clé" 

                                  value="<?php if (!empty($_SESSION["ic_motcle"])) echo $_SESSION["ic_motcle"]; ?>" 

                                  maxlength="100" />

                                </label>

                              </td>

                            </tr>

                            <tr>

                              <td colspan="2">

                                <label>Par date d’envoi</label><br />

                                <input  type="date" name="d_env"  id="d_env" style="width:185px" placeholder="  01/01/1980  " value="<?php if (!empty($_SESSION["ic_d_enve"]) and ($_SESSION["ic_d_enve"]!='')) echo $_SESSION["ic_d_enve"]; ?>" maxlength="100" />

                              </td>

                            </tr>

                        </table>

                    </td>

                    <td  width="30%">

                      <table>

                        <tr>

                          <td>

                            <label>Par sujet</label><br />

                              <input  type="text" name="sujet" style="width:185px" 

                              placeholder="Sujet" value="<?php if (!empty($_SESSION["ic_sujet"])) echo $_SESSION["ic_sujet"]; ?>" maxlength="100" />

                          </td>

                        </tr>

                        <tr>

                          <td><label>Par type d’envoi</label><br />

                            <select name="t_env">

                              <option value="" selected="selected"></option>

<option value="Envoi automatique" <?php if (isset($_SESSION["ic_t_env"]) and $_SESSION["ic_t_env"] =="Envoi automatique") {echo ' selected="selected"'; }?>>

Envoi automatique</option>

<option value="Envoi manuel" <?php if (isset($_SESSION["ic_t_env"]) and $_SESSION["ic_t_env"] == "Envoi manuel") {echo ' selected="selected"';} ?>>

Envoi manuel</option>



                            </select> 

                          </td>

                        </tr>

                      </table>

                    </td>

                    <td  width="30%">

                      <table>

                        <tr>

                          <td>

                            <label>Par nom</label><br />

                              <input  placeholder="Nom de candidat" type="text" name="nom" style="width:185px" value="<?php if (!empty($_SESSION["ic_nom"])) echo $_SESSION["ic_nom"]; ?>" maxlength="100" />

                          </td>

                          <td>

                            

                          </td>

                        </tr>

                        <tr>

                          <td>

                            <label>Par titre message</label><br />

                              <input  placeholder="Titre de message" type="text" name="t_msg" style="width:185px" value="<?php if (!empty($_SESSION["ic_t_msg"])) echo $_SESSION["ic_t_msg"]; ?>" maxlength="100" />

                          </td>

                          <td>

                          </td>

                        </tr>

                      </table>

                    </td>

                  </table>

                  <br>

                  <input type="submit" name="envoi" class="espace_candidat" value="Filtrer" /> 

                  <input type="submit" name="actualiser"  class="espace_candidat" 

                  OnClick="javascript:window.location.reload()" value="Actualiser"> 

                  <div class="ligneBleu"></div>  