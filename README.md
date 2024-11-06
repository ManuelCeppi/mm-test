Rental test project.
## Analysis
Here a google document with all the considerations about the project:

[Google Doc Analysis](https://docs.google.com/document/d/18Uu5sCGhP66XYpivaJN6ShhmwvXMJJ2f1jl9TQGIh80/edit?tab=t.0#heading=h.lptxaac2ewdo)

## Basic System Design
[Basic System Design]([https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=system_design.drawio#R%3Cmxfile%3E%3Cdiagram%20name%3D%22Pagina-1%22%20id%3D%22hKlK21Qtvz9iypfL9PDR%22%3E5Vlbc5s4FP41ntl9aAaQMfgxcdLuQ9Jm63a2flRANmpkRIXwpb9%2Bj0Bc5cRuBpvu7JPRp9vROd%2B5SB6h2Xr3QeAkeuAhYSPHCncjdDtyHHuMxvCjkH2BeP6kAFaChnpQDczpT6JBS6MZDUnaGig5Z5ImbTDgcUwC2cKwEHzbHrbkrL1rglfEAOYBZib6Dw1lpFF7Mq07%2FiJ0FemtfccrOta4HKxPkkY45NsGhO5GaCY4l8XXejcjTCmv1Esx7%2F0LvZVggsTylAnLr4vPDw%2Bz7Q5%2F%2FJu%2BTz5%2B%2BZEt3iEtm9yXByYhnF83uZARX%2FEYs7savRE8i0OiVrWgVY%2B55zwB0AbwO5Fyr42JM8kBiuSa6V4QWOy%2F6fl5Y6EaV27ZvN01O2%2F3ulXIqgR8UQUaSnkmAvLKuUsqYbEi8pVxTmUoYDjhawLywDxBGJZ005YDa6qtqnG1NeBDG%2BQXjKPX3WCW6Z2uk8QwWG0OpdttRCWZJzg%2F%2FRZ8sq16wSUIzuOWRjdESLJ7XaemDsoJU81v7eDIdsCQObKtHWaioajhKhPrTHqbDkHqHsnpnEhOf1ByOsOGjjpaLJp95w8dp1pnPKR1HCN0fL6bf1lmauKciA2FIzrWH%2FdY4A1hf%2F5uQWXstYOK46Mrz4wqNrLMsGLbXhmA%2Bie9ZWhqQNJblyP9%2BL%2BQL8cG6edS0IQYNjvCZ5wmRSm5pDtltz4YPekw2i7Lwgad%2FQNs9s%2BVJF1TWTl7TIIzBsW2IjJUsIkCA8az8HhY6EFryDmutQq7iNomhtpMhcXhtbp5QCvmsVJciNOoCqYNDSn8EUtJRJwjjoWUmqXgz9VtwzEiCNlR%2Ba3xvWh815FANQbMfu5huzbs5h4wW4mdHC%2F0Do%2BcwkFqZ0OdmtTr0KE4pp7VvDN1F%2FI7CzmdhQo9GAvl1KqO%2FXa2eQbbIMuCJYFewuAduJnsBDJGV4pZAZiZCACUM1K43F7rjjUNwyJHkZT%2BxE%2F5UooxiTpRfkb3ZuTeqrUgLaVFhrIrks44A0Eqni8pYx2oj2KgY83qbaBBJu8AmdC5YoBvWOVhP%2F%2FBDINU8XLPKPivQMdj5lPh6fdPFYCD51Xu%2F58yCctU%2BtemcPvRsWu5LR2PfVPHk0vGWdu8%2FObU35KniPNn5QQbop3u%2F%2BAEbscJbOSflgnP5gX22Mx8w70deZd8PEInJsFhX4%2BQ4UE3EEw%2BLZf55W%2F4krh6FCpjjjdwSWyfUNwFmdhUpVyj0gsYTlMadC%2FGB%2Bu2KzSZNmq3d9aVZfmvFnCq8UgEhXOqEFbT2%2FSE3%2B8N9YWHkMuUgva0eg0oazjrjcUgELSzVCXkkXIQSIL3jWE6sfyC0OVOL8mGOtfL9nD4KETotTi1zeo0wft1npXBbCsK6bF4F%2BozSR8KVG0%2F6yE0Ibutzslp1dAbci0067%2BACsvUf6Shu38B%3C%2Fdiagram%3E%3C%2Fmxfile%3E#%7B%22pageId%22%3A%22hKlK21Qtvz9iypfL9PDR%22%7D](https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=system_design.drawio#R%3Cmxfile%3E%3Cdiagram%20id%3D%22QjKrfuGghV-Z23UTVnNM%22%20name%3D%22Pagina-1%22%3E1VlZc9MwEP41mYEHGMvylcekLTBMgQ5hpvRRtRVb1LGMLOfg1yPF8innKKQ2vGS8q8PSt98e3kzg1Wr7nqE0%2BkQDHE9MI9hO4PXENE3HFr9SsSsUrucUipCRoFCBWrEgv7BSGkqbkwBnrYmc0piTtK30aZJgn7d0iDG6aU9b0rj91hSFWFMsfBTr2nsS8EhpgTOtBz5gEkbq1Z7pFgMrVE5WN8kiFNBNQwVvJvCKUcqLp9X2CscSuxKXYt27A6PVwRhO%2BFkLjPdv6NU9nkEv%2FJDlH8Msmr1Ru6xRnKsLX8%2BF%2FOrTbvEzfq0OznclGuIOqXz0dzFJAszgBM43EeF4kSJfDmwECYQu4qtYSEA8PtJczAxuHysF8p9CJrVfci62wUqfFbYHtnhWp8KM4%2B3B64IKREE%2BTFeYs52YUi5woQJeMc%2B2lLyp7egoVdS0oNIhxZyw2roGVzwofJ%2BBtalhvRB3URs3URZ7CXpjiUmJd0zz4DTWl4DN8tqwAUOHDZhD4uboAAXCR5VIGY9oSBMU39TaOStYJ8YNIdVzbilNFVg%2FMOc7FXBQzmkflPJFx4EU56I58%2FGR80MVthALMT8yz%2Bo3DMMx4mTdPsfFQYYaOWdpqgFfwwqGYSN022yEUGej20NG56XI6I5Bxn2Y%2BK7W74UHKby1S%2FF62xy83inpgiS2ziSxPSaJLY3En0OSbIXqaw%2BXI7p6zLNheFwln5LHps5jb8igCqxRiQxGI7J9JpGnf0nk%2FdIZY2jXmJBSkvCssfOdVDR44nWyL3Q6Rd2pBcAyOtwozlAzpbrMn5PH7kkWRHrZzeLbMpfLF5itibCDKCVvEUNr3FNMDp5MXON0MuktbV4sm3jjZpPa7x5abtfvhHvpDjMi7o7ZeJ55wMrDpBhgj2wy81k2u6B5pgNVAH8WOLtfe4PEwakWBxecEfHF1qXIieCGsrToXSzJVtLkMtHujA%2B5YUsOQ4NLA8rP2bpKCTgJZrKFM5EfwCjLiN%2BGre1WeEt4I6oJ6aExUvuHFFohrVhktP3qLThVk7x0ODz3s%2FFAodKwst1j5VL3PLfU%2Fc4CbZaZ0w59inuqZccqGcvp7GR1diqQ0HZ6dqioau%2FyRe6JGqsCq%2BNJh69yaoLbuet0gGAF4L9UbIDhEhco%2B8b%2FdAOmPGUjOs6R%2F%2FRludzX0WPXzta0zdhKHqsRA5zT2aSRQBIqG83zAGVRBVsDIqm%2FQ1wE8mSvMQ3Z2s44o09V3988knK8ZsqppANJRwjdvHGgwzOck5hn%2BsiB6m6gbNOt8mCXXmdnm251BMF52eZi0djV6EsTaUzBV6YRWTgu75SMMQklVX1hacmiuXRv4qN4pgZWJAj2IbwvOLRpfIn44HQaXGbPt3Xfvy3wxeKD1w%2FwBj9GlD5JqNdY2fY%2Fg9px2uVITy8RlP29v8RaiPU%2FlAX367954c1v%3C%2Fdiagram%3E%3C%2Fmxfile%3E#%7B%22pageId%22%3A%22QjKrfuGghV-Z23UTVnNM%22%7D))

## DB Schema
[Database Schema](https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=database.drawio#R%3Cmxfile%3E%3Cdiagram%20name%3D%22Pagina-1%22%20id%3D%22u7Kpg7bZ3AoJ5nyOm1zw%22%3E7Z1bc%2BI6Esc%2FTR5D4Sv4cchcztbOnM2ZzNbOeaI8tgLeYyzWNkk4n35lIxvslsEE21JCU1M1wTEEun%2B69F%2Bt1o1xt3r5Ervr5Tfqk%2FBGH%2FsvN8bHG13XTMNk%2F2VXtvyKrRm7K4s48Pm1%2FYWH4G%2FCL4751U3gk6RyY0ppmAbr6kWPRhHx0so1N47pc%2FW2RxpW%2F%2BraXRBw4cFzQ3j1P4GfLvlVzXb2v%2FiNBIsl%2F9NTfbL7xcotbubfJFm6Pn0%2BuGR8ujHuYkrT3U%2BrlzsSZtYr7LJ73eeG35YfLCZR2uYFdw%2BTn%2F%2B6fYrvt%2BOxNV47P%2B8e17cm%2FxpPbrjh35h%2F2nRbmGAR0836xpglaUz%2FInc0pDH7hU8e3U3I%2FvIMfhD%2B2Z5InJIXkZvcX8Wb7y3BGCJ0RdJ4y%2B7jrzJtbjyOT2nM5wNfmPza8sANenHR5f5flO%2B9NxH7gVvpDIvZwGAPqZsGNEqA4ZLnYBW6EXs2e6RR%2BsB%2FM2bPvWUQ%2Bl%2FdLd1kHzhJXe%2Bv4tlsSePgb3a%2Fyz7XRy03vBunvGkY48odD9kr%2BXvGJGH33Bd%2B0GqXvrkvlRu%2FuklafBoahu46CXZeyV64cuNFEM1omtIVv%2Bl5GaTkYe162T3PrLlnHyRdlR%2BSf9mvQUTKz30ITERzS0BajoNZZwiycooFTT%2FCAn%2B77xmU0YJ9%2F2b2ppC9qeDPGbW%2F5oYpiSM3JTO6ifwEAFh%2Bk9czOQFMstv18f0%2FAZLMlmmTZx6DMKxdcsNgEbGnIXnMXpY5I2B94wd%2BeRX4fvbOs4RhEUSLr%2FltH839le%2FcLtklyl7%2BGOZd4JK9kLB3mK1pEKW5oawZ%2B8dMdzceWTcW%2B6x37Lm2f87%2BZbfH6R1ramnsBjk%2BhEH8TDKQZzFl7ZB3LC14bcmh3RrDbdX9p6isY9JZBzUFMETuiiAJg5NgyyYBju1ekG6RhMFJcGSTYFoABWYvQlKE4VIYzpioFDFQ20lsfzjASeyasllmOPdYBIdMSGDCks4EnER6bMLK3hqhkAWFIOIYGAo4mVy5L8Fqs5p7buYXnE7IAKNUx6SBMYEyEfEXpJA4mA2XdEEjN%2Fy0v8rMxwJg4nPj7e%2F5Sumam%2By%2FJE23XOpwNymtGpRk3dHP7PXMYfzpn%2Fzt8icfXyrPtvwZdASXoxK6iT1y5HtafKRM3XhBWswJMyMc9WBMQjcNnqrqYvfuMa7EPdbbdI95Je6ZvEn3OCYY9YC%2FJIrik2KueEQUL68djgam1dtwAOPLlhY7TxUuPfN6I54yUn8rBxMYdf07ITGuG3S5blCSeNa6gZCE979u4Bhtm21L4zcpY%2B2bZ7OKLvSR01tjxTWV3gKeErvL22h%2FAQ4uo0h3%2Fpl9QX8swIWUZBMjDnJwECyrDYtDMXijUtoTE2fM4Y4sqQwMhQagICs3CJEGCTQIFlMGpkEHNPwK4nQ599l8HpGQgIQgCBsYCRhrrd0keaaxj0AMD4RoCWVgIASL8Evm0Hm0Wf0iMUJx8dSySSxshsKEUGhTbaRNbHMytqZT3bCMIRGBIgRXmOdrd7tiX3%2FO%2FtCS%2BvNcm%2FiM2oQMaCbSexKoVRR4LNh849llgckmSdlfi3NQkJGhGTHG0hmBGkYen8zZlwgeA%2BLPXUwGlEGGdHXLgXKGT71N3n3s4PDy%2FS3YdcgBRLre5UBpowYI9h6y4BBklg8MB1Q63E26nKfM5xEiMTwSpnQpVDMgE4AEmfkzRZTHLXartdUCyql%2B980IigEtTXZeesTeN28xg8aB8fA9iZMsC%2B6D55Ek%2BZH1OphQ02VCjdN%2BtxMm1DgwEm9oxi2NP2kw%2FttLqHFgAIoJNV3NEqYNmCiUUKMVEsgBAPkkMbPGPN2ucV1sSA5Uya3RxjC63GOBkoMMKKQrDtoYRhCYbtUJDGfvXZefWqON4dI5yguycJCeW6ON4fYc91cQBmlAYOiHSPSPhPTcGm0M9x%2BFzFDzTYLStCQq5CfYaIYgJ%2FNlHcQkQSY6YKJZSzwrwWZgKAS1TwAKDRJNZwo0m1PVJC3RJMsS2OWohHZha%2Blg16uXaaFBROKbpq3DJ5zSjSo9tOUaNnbe75JwvuUpWqhKt1KlOyfoFCmj8eFDkN33%2FlVrzYCyNWqzp4gegNQjIl0LcHucWEEtn820Y8xCVQgakYgnFZpi6nckS1WQ1IwkSSdJlGMkl6QJ4OJdls8p%2B9mT9XMmahXQ0Yq6TO%2FeQ8V2kLfnIRXCYK0WBpvimQ7sW3rLUijlbRlRsNV%2FFNyj4aDY9m31jygPXkKsc9R7ANwIT7eQvI%2BA19IBrBjw9jXjPINMVQNeC65AY8CrGDTKBbztiyIOOMWyW6%2Ff99iaYBr3YHOsxkoB3eW%2F92g5Gwq12Rd2Q9RK%2BuiEXlFWQrEKAuU5dQLVDVU2pciRXkZAKz7BYWLVKqtshoAoAIj8GgKaBTsTvsadBfqZBzDE7zHEx9rGZ418MJ%2FFW2Yy7dwniRcH66yoAfZsCvRsCqSY2zBW47CwnifdYF6xEpzIzz234bLJjhNMM1YFEvnZ6DbUN0q1EAmRTogCmek2XCzD9Qd1CJG%2FK9aGC1T1ZKkgD7mwU1EDGfl7Zm24RsWnsIiIEohIr9WlFUlI0tKyTKuamDVy2FzpeHJW%2FuyexAGzwREntc7YstueSVdUNlMlY2siN%2BtRqzrOOuG2SzzUNuux3LegioscycduDuWiommcbkNO1w7iL73Pxou9LmnXjkS8rRdq231S%2FqqLxMYfky35MY6Cp8k8uPsjCGasR7mFAZ8GSOBD7oHjilHVI1HetTWPq7lcfTCmVYfLbETMsEh2hDTqzoKBvZGBFsNaYfv6XsaiVR6Mc0ZPw5zQGUV4d5Xe0GotwRIsKw7rDRjq%2Fn493hhPqu6YCtSpYd0BA8vraRzTWuOwpTcOGLNdc%2BMQ6PvDugMuGV5P47CMqjc0Qbw6rDfgmtz1NA6jNqsyBKL1sN6AK19X7A1Bmt%2Bw3oARxxV7Q%2FowDtNyr2fcmCo3bsAstetpG1opnxXhuC05HC8k7qtsHGCOa8oOAHUYj1%2BRO8xaBChdrNJhPH5FnZWhV93hyJ7l6jAgv57WMdGq3tjXbJflDkFNuutxx7S%2BdU%2F20CEoEwacIfFcn9I%2BRWciKjYp2u9eJoR13528eqdj660Cxz2ldiUJsc0gZXyTyZdd5tOnJ9xq0t1Wk%2FP4OZ%2BTo41LsNNE6k4SMZB4cs1ND2lVl4Inv1aE%2BBvAcLeeuUmeMHFTFXwkVo0QfwMYntfwQWrkUyOxJKL4G0AVYR3T7EREgr2MArwIdzhKBQau5uERbIqwItrlKJUVGMT6zHLIigKsiDY7ymTFhNMXwIlEiUirSURWwfbJM437K5w5hQFDS5NdFuObl1v1pNXs6cjSpvt%2FRm9GFJwJhqVreumlGrlp7KVYOxtZh4%2BWjc7QR%2Frhoz96YKbZ97ysGqqMfaqMZ5B0ChW7PSoCzVHp6ja%2F%2B08%2Fp79t7r2HL7M%2FboPvf37%2BcHeL%2B8e76u8Ew9%2FpzZ%2B7DuMsTVJuBwen8HkHxPyVF7gJaIR6pBJjpWOP7MOHckMlXJ0jkY8cqcaRpk9H04OHoxhHDhzBsKK2WgjZ5sg8fNjSEBKrJXBZNh%2FT5j6beSE%2F8vnRbG2kVR5qASQ4kIwNZYiPKvg4xsg4fJjS8BGGYHDJLWbk4ADWTxx2BKpm3cmajCYHD5jqLbX%2FsTo4cBkaqjOt3Kyln7ZOpyy3Z3XfY8M219JilwlVpaf6S6fsLwfVhCnt78VoveWgmrBpVnNQv9IFasN9asON9HRLyVsTg8W0wuULVIN7mseewaWiCaomTP1hYc%2B6LI2FuEjFRbWEVBOLWStMi2qJqKbogLL%2FbTIjIi3SaVEuDdWEGi6brK6ZWVGCU4EX1VJRBadz785nmXvUR2RUQEa1jFTBueR8REKlXxFmhAdySGVGoO3zYQmhUQUasRwtERqos%2BLOPfWwER2zKhWb1iUi%2Blvq0epap6Dui1a0t8qqRb3OemcJQpMONpK8FqrJxXaVZzfBCeG%2F3DQl8RZPMuyrE2ri5ayxS8hJb0fBCGbFDx6ljBNc1up1Was9K6fYeP9H%2BFpwXWsdB8yn20qyMWbbKNGpicTFgTs1uLIVMrshLArCIlAWB4YFzru9TZx9UeRFQV4Eo9TAvMCJNU6oVcFDpCAOjAeUDDEHRxk%2BBDk4A%2BMBxcENZlCogIYg32ZgNGCuaeSucI1BATYE2TW9sSHcY2ICCoY9r1evHNdb%2FvL8o3prB4C%2B8mTYYtNoy7N7oV%2FPO2b0QxxnizblDZz4%2FTufOIXU5ufCfG55f1F%2Fven%2B6dg6dj%2F7YfeJXyvCCBF844dwndhWdLwCe30LjDXg0TZCZ8g9v%2FtVR0B30%2FKnbU%2Ftnkhp%2BLVjLIqG3djwa%2FezF%2FTfkN%2F4qUidNmRboFUO2pCLePUKW%2FJ0yJZ8uum1PCn8%2FC5BqxI31U90CdX7B%2BkS3vrZzN32CQOePiveUG5I7RPqs%2F1xL53Csa30h12CmNeGslut%2B4TL%2FAOXl4DD2u3Xbp1Zcg7P9cOURRuJxNvds%2F3ufY1zUBZtabOj6%2ByvNOARtx5df%2B%2BvJKzYaP3s2FbCaD1UhD3SVVRLeooydzG55RJ%2BeuPk2up56hDX85r8cE38zBqXutPn8NJU9nm%2BJvF8yeYdwIooo19Uh%2BcIvc2L9061%2FrMtr5KcmCLBAQck8eJgnaWBIEHyCbJrVVENxQASJV0nZI4l6FUByKlVQ5VXilAMEBRncQ1YDXIMZaqgij893BF9MANaBdEGtyuqgJFm1IqhKoYRVIIPMEoIs5OPGCmAkV0tiqqr1h1BvY%2F9GPjzx5iuECD5AOl6rSaqalNpKLJjGr58elTBQ4eCz65%2FSSnyoUDvYjkjxznoXVQbnqDSozVx8%2B4WvLXagvdUIOEOu%2BANZZPrST%2FQ6smfgsWJjrzBnsaUpocrFqyLWH6jPsnu%2BD8%3D%3C%2Fdiagram%3E%3C%2Fmxfile%3E)
