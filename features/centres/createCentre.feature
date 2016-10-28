Feature: Create centre
  In order to registry a new centre at UIC
  Center Managers should be able to
  specify all the information related to the new centre

  Rules:
  - Can't be more than one centre with the same code
  - A centre must have a code
  - Can't be more than one centre with the same name
  - A centre must have a name

  #Background:
  #  Given an existing centre type named "Tipus1"
  #  And another existing centre type name "Tipus2"

  Scenario: Create first centre
    Given there are no centres created
    When I create a new centre with code "FCS" and name "Medicina i Ciències de la Salut"
    Then there should be 1 centres in the list

  Scenario: Create centre with repeated code
    Given one centre with code "ARQ"
    When I create a new centre with repeated code "ARQ" and name "Escola d'Arquitectura"
    Then I should see "ja existeix el codi!!"
    And there should be 1 centres in the list

  Scenario: Create centre with repeated name
    Given one centre with name "Facultat de Dret"
    When I create a new centre with code "CJP" and repeated name "Facultat de Dret"
    Then I should see "ja existeix el nom!!"
    And there should be 1 centres in the list