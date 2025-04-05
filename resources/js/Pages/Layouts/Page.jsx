export default function Page({children})
{

    return <div className="h-screen w-full relative p-2 sm:p-6 overflow-scroll">
        {children}
    </div>
}