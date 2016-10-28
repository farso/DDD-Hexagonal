Feature: Delete centre
  In order to...
  Center Managers should be able to...

  Scenario: Delete centre
    Given exist 2 centres created
    When I delete a centre with id 1
    Then there should be 1 centres in the list