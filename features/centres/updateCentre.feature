Feature: Update centre
  In order to update a centre
  As a Center Manager
  specify all the new content of an existing centre

  Scenario: Update an existing centre
    Given a centre with name "ABC"
    When I update the name of the centre with name "ABC" to "CBA"
    Then the name of the centre with changed to "CBA"

  Scenario: Update centre with a repeated name
    Given a centre with name "ABC"
    And a centre with name "DEF"
    When I update the name of the centre with name "DEF" to "ABC"
    Then I should see the exception "ja existeix el codi!!"
    And there should be a center with the name "ABC"
    And there should be a center with the name "DEF"


