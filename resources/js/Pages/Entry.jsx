import { router } from "@inertiajs/react"
import { route } from "ziggy-js";


export default function Entry()
{
    console.log(route('init'));
    return <>
    <div className="bg-yellow-900 w-100 flex h-screen">
       init
        </div>
    </>
}