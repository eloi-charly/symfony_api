import { useEffect, useState } from "react"

const App = () => {

  const [cocktail, setCocktail] = useState([])

  const fetchCocktail = async () => {
    const res = await fetch("http://127.0.0.1:8001/api/coctail")
    const data = await res.json()
    setCocktail(data.drinks)
  }

  useEffect(() => {
    fetchCocktail()
  }, [])

  console.log(cocktail);
  return (
    <div>
      Appt login
    </div>
  )
}

export default App