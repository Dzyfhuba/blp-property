import { columns } from '@/Variables/criterion'
import type { SmarterResponse } from '@/types/smarter-response'

type Props = {
    data: SmarterResponse
}

const Process = (props: Props) => {
  return (
    <>
      {/* Pairwise Comparison */}
      <article id="pairwise-comparison">
        <h1>Pairwise Comparison</h1>
        <div className='overflow-x-auto'>
          <table className='table table-pin-cols'>
            <thead>
              <tr>
                <th></th>
                {Object.keys(props.data.pairwise_comparison).map((key, idx) => (
                  <td key={idx}
                  >
                    {key}
                  </td>
                ))}
              </tr>
            </thead>
            <tbody>
              {columns.map((column1, idx) => (
                <tr key={idx}>
                  <th className='whitespace-nowrap'>{column1}</th>
                  {columns.map((column2, idx) => (
                    <td key={idx}
                      className='whitespace-nowrap'
                    >{props.data.pairwise_comparison[column1][column2]}</td>
                  ))}
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </article>

      {/*  */}
    </>
  )
}

export default Process
