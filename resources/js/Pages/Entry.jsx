import { router } from "@inertiajs/react"
import { route } from "ziggy-js";


export default function Entry()
{
    console.log(route('init'));
    return <>
    <div className="bg-yellow-500 w-100 flex h-screen">
       init
        </div>
    </>
}